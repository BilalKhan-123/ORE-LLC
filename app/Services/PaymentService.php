<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Payment;
use App\Jobs\TestPurchased;
use App\Jobs\UserCouponAlert;
use App\Library\PaymentHelper;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PaymentService
{
    private $paymentObj;

    public function __construct()
    {
        $this->paymentObj = new Payment;
    }

    public function collection(array $inputs)
    {
        $payments = $this->paymentObj->getQB()->orderBy('created_at', 'desc');

        if (! Auth::user()->hasRole(config('site.roles.admin'))) {
            $payments = $payments->where('user_id', Auth::user()->id);
        }

        $payments = $payments->where('status', '<>', config('site.payment_status.pending'));

        $inputs['limit'] = isset($inputs['limit']) ? $inputs['limit'] : config('site.paginationLimit');

        return (isset($inputs['limit']) && $inputs['limit'] == '-1') ? $payments->get() : $payments->paginate($inputs['limit']);
    }

    public function create($inputs)
    {
        $user = Auth::user();

        if (empty($user->stripe_customer_id)) {
            $customer = PaymentHelper::createCustomer($user->full_name, $user->email);

            $user->stripe_customer_id = $customer->id;
            $user->save();

            $user->refresh();
        }

        try {
            $planDetails = PaymentHelper::getPricingDetail($inputs['pricing_id']);
            $productDetails = PaymentHelper::getProductDetail($planDetails->product);

            $examType = null;
            if ($productDetails->name == config('site.exam.plan.cci')) {
                $examType = config('site.exam.exam_type.cci');
            } elseif ($productDetails->name == config('site.exam.plan.cci_glycan_age')) {
                $examType = config('site.exam.exam_type.cci_glycan_age');
            } elseif ($productDetails->name == config('site.exam.plan.cci_plus')) {
                $examType = config('site.exam.exam_type.cci_plus');
            } elseif ($productDetails->name == config('site.exam.plan.cci_consultation')) {
                $examType = config('site.exam.exam_type.cci_consultation');
            }

            $intentParams['user_id'] = $user->id;
            $intentParams['pricing_id'] = $inputs['pricing_id'];
            $intentParams['plan'] = $productDetails->name;
            $checkoutSession = PaymentHelper::createCheckoutSession($user->stripe_customer_id, $intentParams);

            $payment = $this->paymentObj->updateOrCreate([
                //Add unique field combo to match here
                //For example, perhaps you only want one entry per user:
                'user_id' => $user->id,
                'status' => config('site.payment_status.pending'),
            ], [
                'user_id' => $user->id,
                'checkout_session_id' => $checkoutSession->id,
                'payment_intent_id' => $checkoutSession->payment_intent,
                'exam_type' => $examType,
                'amount' => $checkoutSession->amount_total / 100,
                'status' => config('site.payment_status.pending'),
                'payment_by' => $user->getRoleNames()->first(),
            ]);

            $data['data'] = [
                'customer_id' => $user->stripe_customer_id,
                'client_secret' => $checkoutSession->client_secret,
            ];

            $data['message'] = __('message.checkoutSessionSuccess');
        } catch (\Exception $e) {
            Log::info('Checkout payment error : ' . $e->getMessage());

            $data['errors']['message'] = __('message.somethingWentWrong');
        }

        return $data;
    }

    public function store($inputs)
    {
        try {
            $payment = $this->paymentObj->where('checkout_session_id', $inputs['checkout_session_id'])->first();
            if (empty($payment) || $payment->status != config('site.payment_status.pending')) {
                $data['errors']['message'] = __('message.somethingWentWrong');

                return $data;
            }

            $checkoutSession = PaymentHelper::getCheckoutSessionDetail($inputs['checkout_session_id']);

            // $paymentIntent = PaymentHelper::getPaymentIntentDetail($checkoutSession->payment_intent);
            $quantity = PaymentHelper::getOrderQuantity($checkoutSession);
            $discountData = PaymentHelper::getOrderDiscount($checkoutSession);
            $product = PaymentHelper::getProductDetailFromSessionID($checkoutSession);
            $isMultipleExamForParticipant = $product->metadata?->is_multiple_for_participate == 1 ? true : false;

            $hasMultipleParticipantExam = false;
            if ($isMultipleExamForParticipant) {
                if ($checkoutSession->payment_status == strtolower(config('site.payment_status.paid'))) {
                    $hasMultipleParticipantExam = true;
                    $this->syncParticipantMetadata($product, $quantity);
                }
            }
            Log::info('After Checkout session : ' . $checkoutSession);
            $paymentData = [
                'quantity' => $quantity,
                'amount' => $checkoutSession->amount_total / 100,
                'payment_intent_id' => $checkoutSession->payment_intent,
                'status' => ($checkoutSession->payment_status == config('site.stripe.payment_status.paid') ? config('site.stripe.payment_status.paid') : config('site.stripe.payment_status.failed')),
                'response' => json_encode($checkoutSession),
            ];

            if (! empty($discountData)) {
                $paymentData = array_replace($paymentData, $discountData);
            }
            $payment->update($paymentData);
            $payment->refresh();

            if ($checkoutSession->payment_status == strtolower(config('site.payment_status.paid'))) {
                $this->syncClientMetadata($payment, $quantity);
                try {
                    $user = Auth::user();

                    $paymentData = [
                        'name' => $user->full_name,
                        'email' => (! empty($user->email) ? $user->email : '-'),
                        'examType' => $payment->exam_type,
                        'registrationUrl' => config('site.participantWebsiteUrl') . '/signup',
                        'testUrl' => config('site.participantWebsiteUrl') . '/cci-instructions',
                        'productName' => $product->name,
                        'quantity' => $quantity,
                    ];

                    $users = collect();
                    $users->push($user);

                    TestPurchased::dispatch($users, $paymentData);
                } catch (\Exception $e) {
                    Log::warning('Client Test Purchase Notification Error : ' . $e->getMessage());
                }
            }

            $data['participantSiteUrl'] = config('site.participantWebsiteUrl');
            $data['is_multiple_exam_for_participant'] = $hasMultipleParticipantExam;
            $data['status'] = strtolower($payment->status);
            $data['message'] = ($payment->status == config('site.payment_status.paid') ? __('message.paymentSuccess') : __('message.paymentFailed'));
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            Log::warning('Update payment status error : ' . $e->getMessage());

            $data['errors']['message'] = __('message.somethingWentWrong');
        } catch (\Exception $e) {
            Log::warning('Update payment status error : ' . $e->getMessage());

            $data['errors']['message'] = __('message.somethingWentWrong');
        }

        return $data;
    }

    public function handlePromotionCodeWebhook($eventType, $promotionCode)
    {
        $customerId = $promotionCode->customer;

        $user = User::where('stripe_customer_id', $customerId)->first();

        if (! empty($user)) {
            try {
                $couponCode = $promotionCode->coupon;

                $promotionCodeData = [
                    'couponCode' => $promotionCode->code,
                    'discount' => (! empty($couponCode->percent_off) ? $couponCode->percent_off . '%' : config('payment.currency_icon') . '' . number_format($couponCode->amount_off / 100, 2)),
                    'validUntil' => (! empty($promotionCode->expires_at) ? Carbon::parse($promotionCode->expires_at, 'UTC')->format(config('site.format.date_time')) . ' (UTC)' : '-'),
                ];

                $users = collect();
                $users->push($user);

                UserCouponAlert::dispatch($users, $promotionCodeData);
            } catch (\Exception $e) {
                Log::warning('User Coupon Alert Notification Error : ' . $e->getMessage());
            }
        } else {
            $data['errors']['message'] = __('message.somethingWentWrong');
        }

        return $data;
    }

    /**
     * Class private methods
     */
    public function syncParticipantMetadata(object $product, $quantity)
    {
        $authUser = auth()->user();
        $plans = [
            config('site.exam.plan.cci') => config('site.exam.exam_type.cci'),               // "CCI Basic"
            config('site.exam.plan.cci_plus') => config('site.exam.exam_type.cci_plus'),     // "CCI Plus"
            config('site.exam.plan.cci_consultation') => config('site.exam.exam_type.cci_consultation'), // "CCI Consultation"
        ];

        $metadata = [];
        $productName = $product->name;

        if (isset($plans[$productName])) {
            $metadata = $authUser->getParticipantMetadata($plans[$productName]);
            $metadata['purchased_exam_count'] += $quantity;

            $authUser->participantMetadata()->updateOrCreate([
                'plan_type' => $plans[$productName],
            ], $metadata);
        }
    }

    private function syncClientMetadata(object $payment, int $quantity)
    {
        $client = $payment->user;
        $totalCciCount = 0;
        $totalCciGlycanCount = 0;
        $totalCciPlusCount = 0;
        $totalCciConsultationCount = 0;

        if ($payment->exam_type == config('site.exam.exam_type.cci')) {
            $totalCciCount += $quantity;
        } elseif ($payment->exam_type == config('site.exam.exam_type.cci_glycan_age')) {
            $totalCciGlycanCount += $quantity;
        } elseif ($payment->exam_type == config('site.exam.exam_type.cci_plus')) {
            $totalCciPlusCount += $quantity;
        } elseif ($payment->exam_type == config('site.exam.exam_type.cci_consultation')) {
            $totalCciConsultationCount += $quantity;
        }

        $metadata = $client->clientMetadata;
        $client->clientMetadata()->updateOrCreate(['client_id' => $client->id], [
            'total_cci_count' => ! empty($metadata->total_cci_count) ? $metadata->total_cci_count + $totalCciCount : $totalCciCount,
            'total_glycan_count' => ! empty($metadata->total_glycan_count) ? $metadata->total_glycan_count + $totalCciGlycanCount : $totalCciGlycanCount,
            'total_cci_plus_count' => ! empty($metadata->total_cci_plus_count) ? $metadata->total_cci_plus_count + $totalCciPlusCount : $totalCciPlusCount,
            'total_cci_consultation_count' => ! empty($metadata->total_cci_consultation_count) ? $metadata->total_cci_consultation_count + $totalCciConsultationCount : $totalCciConsultationCount,
            'conducted_cci_count' => $metadata->conducted_cci_count ?? 0,
            'conducted_glycan_count' => $metadata->conducted_glycan_count ?? 0,
            'conducted_cci_plus_count' => $metadata->conducted_cci_plus_count ?? 0,
            'conducted_cci_consultation_count' => $metadata->conducted_cci_consultation_count ?? 0,
            'number_of_participants' => $metadata->number_of_participants ?? 0,
        ]);
    }
}
