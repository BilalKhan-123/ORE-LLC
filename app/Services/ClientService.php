<?php

namespace App\Services;

use DB;
use App\Models\User;
use App\Library\Helper;
use App\Models\Payment;
use App\Jobs\WelcomeUser;
use App\Traits\BaseModel;
use App\Library\PaymentHelper;
use Illuminate\Support\Facades\Log;

class ClientService
{
    use BaseModel;

    private $userObj;

    public function __construct()
    {
        $this->userObj = new User;
    }

    public function collection(array $inputs)
    {
        $users = $this->userObj->getQB()->role(config('site.roles.client'));

        $inputs['limit'] = isset($inputs['limit']) ? $inputs['limit'] : config('site.paginationLimit');

        return (isset($inputs['limit']) && $inputs['limit'] == '-1') ? $users->get() : $users->paginate($inputs['limit']);
    }

    public function store(array $inputs)
    {
        $password = Helper::generatePassword();
        $clientCode = Helper::generateClientCode();
        $inputs['password'] = $password;
        $inputs['client_code'] = $clientCode;

        DB::beginTransaction();
        $user = $this->userObj->create($inputs);
        $user->assignRole(config('site.roles.client'));
        $this->addExamPurchase($user, $inputs);
        DB::commit();

        try {
            $customer = PaymentHelper::createCustomer($user->full_name, $user->email);
            $user->stripe_customer_id = $customer->id;
            $user->save();
        } catch (\Exception $e) {
            Log::info('Stripe customer create error : ' . $e->getMessage());
        }

        try {
            WelcomeUser::dispatch($user, $password)->onQueue('mail');
        } catch (\Exception $e) {
            Log::info('Error Send Welcome Email : ' . $e->getMessage());
        }

        $data['message'] = __('entity.entityCreated', ['entity' => __('message.client')]);

        return $data;
    }

    public function resource($id, $inputs = [])
    {
        $user = $this->userObj->getQB()->role(config('site.roles.client'))->findOrFail($id);

        return $user;
    }

    public function update(int $id, array $inputs)
    {
        $client = $this->resource($id);

        DB::beginTransaction();
        $client->update($inputs);
        $this->addExamPurchase($client, $inputs);
        DB::commit();

        $data['message'] = __('entity.entityUpdated', ['entity' => __('message.client')]);

        return $data;
    }

    public function destroy(int $id)
    {
        $this->resource($id)->delete();
        $data['message'] = __('entity.entityDeleted', ['entity' => __('message.client')]);

        return $data;
    }

    public function changeStatus($inputs)
    {
        $client = $this->userObj->findOrFail($inputs['client_id']);
        if ($client->hasAcccessManageClientStatus()) {
            $client->update(['status' => $inputs['status']]);

            if ($inputs['status'] == config('site.user_status.inactive')) {
                $isDeleted = $client->tokens()->delete();
            }

            $data = [
                'status' => true,
                'message' => __('message.changeStatusSuccess', ['module' => __('message.client'), 'status' => $inputs['status']]),
            ];

            return $data;
        }
        $data['errors']['message'] = __('message.invalidAction');

        return $data;
    }

    public function updateAllowMultipleAttempts(array $inputs)
    {
        $userObj = $this->userObj->findOrFail($inputs['user_id']);

        $isUpdated = $this->userObj->where('client_id', $userObj->id)
            ->role(config('site.roles.user'))
            ->update(['allow_multiple_attempts' => 1]);

        $resUser = ['name' => $userObj->first_name . ' ' . $userObj->last_name];
        $data['message'] = __('message.allowAttempt', $resUser);

        return $data;
    }

    private function addExamPurchase(object $client, array $inputs)
    {
        $totalCciCount = 0;
        $totalCciGlycanCount = 0;
        $totalCciPlusCount = 0;
        $totalCciConsultationCount = 0;

        if (! empty($inputs['purchase_exams'])) {
            $examPurchaseArr = [];
            foreach ($inputs['purchase_exams'] as $item) {
                $examPurchaseArr[] = new Payment([
                    'exam_type' => $item['exam_type'],
                    'quantity' => $item['quantity'],
                    'payment_by' => config('site.roles.admin'),
                    'status' => config('site.payment_status.paid'),
                ]);
                if ($item['exam_type'] == config('site.exam.exam_type.cci')) {
                    $totalCciCount += $item['quantity'];
                } elseif ($item['exam_type'] == config('site.exam.exam_type.cci_glycan_age')) {
                    $totalCciGlycanCount += $item['quantity'];
                } elseif ($item['exam_type'] == config('site.exam.exam_type.cci_plus')) {
                    $totalCciPlusCount += $item['quantity'];
                } elseif ($item['exam_type'] == config('site.exam.exam_type.cci_consultation')) {
                    $totalCciConsultationCount += $item['quantity'];
                }
            }

            $client->purchasedExams()->saveMany($examPurchaseArr);
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

        return true;
    }
}
