<?php

namespace App\Library;

use Auth;

class PaymentHelper
{
    private static $providerObj;

    public static function connectProvider()
    {
        self::$providerObj = new \Stripe\StripeClient(config('payment.stripe.secret'));

        return self::$providerObj;
    }

    public static function getPlans()
    {
        self::connectProvider();
        $response = self::$providerObj->products->all(['expand' => ['data.default_price']]);

        $subscriptionPlans = isset($response['data']) ? $response['data'] : [];

        return $subscriptionPlans;
    }

    public static function createCustomer($name, $email)
    {
        self::connectProvider();
        $customer = self::$providerObj->customers->create([
            'name' => $name,
            'email' => $email,
        ]);

        return $customer;
    }

    public static function createCheckoutSession($customerId, $params)
    {
        self::connectProvider();

        $pricing = self::getPricingDetail($params['pricing_id']);
        $product = self::getProductDetail($pricing->product);

        $adjustQuantity = [];
        $returnUrl = '';

        if (Auth::user()->hasRole(config('site.roles.client'))) {
            $adjustQuantity = [
                'enabled' => true,
                'minimum' => config('site.exam.client_payments.min_quantity'),
                'maximum' => config('site.exam.client_payments.max_quantity'),
            ];
            $returnUrl = url(config('site.frontWebsiteUrl') . '/payment-status?session_id={CHECKOUT_SESSION_ID}');
        } elseif (Auth::user()->hasRole(config('site.roles.user'))) {
            $isMultipleForParticipate = $product->metadata?->is_multiple_for_participate ?? false;
            if ($isMultipleForParticipate) {
                $adjustQuantity = [
                    'enabled' => true,
                    'minimum' => config('site.exam.client_payments.min_quantity'),
                    'maximum' => 10,
                ];
            }
            $returnUrl = url(config('site.participantWebsiteUrl') . '/payment-status?session_id={CHECKOUT_SESSION_ID}');
        }

        $checkoutSession = self::$providerObj->checkout->sessions->create([
            'ui_mode' => 'embedded',
            'customer' => $customerId,
            'line_items' => [[
                'price_data' => [
                    'currency' => config('payment.currency'),
                    'unit_amount' => $pricing->unit_amount,  // 2000 cents (USD $20.00)
                    'product' => $product->id,
                ],
                'adjustable_quantity' => $adjustQuantity,
                'quantity' => 1,
            ]],
            'invoice_creation' => ['enabled' => true],
            'metadata' => [
                'Plan' => $params['plan'],
                'payment_for' => config('site.stripe.items_payment_for'),
            ],
            'mode' => 'payment',
            'allow_promotion_codes' => true,
            'return_url' => $returnUrl,
        ]);

        return $checkoutSession;
    }

    public static function getPaymentIntentDetail($paymentIntentId)
    {
        self::connectProvider();
        $paymentIntent = self::$providerObj->paymentIntents->retrieve($paymentIntentId, []);

        return $paymentIntent;
    }

    public static function getProductDetail($productId)
    {
        self::connectProvider();
        $product = self::$providerObj->products->retrieve($productId, []);

        return $product;
    }

    public static function getPricingDetail($pricingId)
    {
        self::connectProvider();
        $pricing = self::$providerObj->prices->retrieve($pricingId, []);

        return $pricing;
    }

    public static function getCheckoutSessionDetail($sessionId)
    {
        self::connectProvider();

        $session = self::$providerObj->checkout->sessions->retrieve(
            $sessionId,
            [
                'expand' => [
                    'line_items',
                    'total_details.breakdown',
                    'line_items.data.price.product',
                ],
            ]
        );

        return $session;
    }

    public static function paymentMethods($customerId)
    {
        self::connectProvider();
        $response = self::$providerObj->customers->allPaymentMethods(
            $customerId,
            ['type' => 'card']
        );

        $paymentMethods = isset($response['data']) ? $response['data'] : [];

        return $paymentMethods;
    }

    public static function attachPaymentMethod($customerId, $paymentMethodId)
    {
        self::connectProvider();
        $response = self::$providerObj->paymentMethods->attach(
            $paymentMethodId,
            ['customer' => $customerId]
        );

        self::removeDuplicateCards($customerId);

        return $response;
    }

    public static function deletePaymentMethod($paymentMethodId)
    {
        self::connectProvider();
        $response = self::$providerObj->paymentMethods->detach(
            $paymentMethodId,
            []
        );

        return $response;
    }

    public static function removeDuplicateCards($customerId)
    {
        $paymentMethods = self::paymentMethods($customerId);

        $fingerprints = [];

        foreach ($paymentMethods as $paymentMethod) {
            $fingerprint = $paymentMethod['card']['fingerprint'];

            if (in_array($fingerprint, $fingerprints, true)) {
                self::deletePaymentMethod($paymentMethod['id']);
            } else {
                $fingerprints[] = $fingerprint;
            }
        }

        return $paymentMethods;
    }

    public static function getOrderQuantity($payment)
    {
        $quantity = 1;
        if (isset($payment->line_items) && ! empty($payment->line_items->data)) {
            $items = $payment->line_items->data;
            foreach ($items as $item) {
                if (isset($item->price->product) && ! empty($item->price->product)) {
                    $product = $item->price->product;

                    if (true || isset($product->metadata->payment_for) && $product->metadata->payment_for == config('site.stripe.items_payment_for')) {
                        $quantity = $item->quantity;
                        break;
                    }
                }
            }
        }

        return $quantity;
    }

    public static function getProductDetailFromSessionID($payment)
    {
        if (isset($payment->line_items) && ! empty($payment->line_items->data)) {
            $items = $payment->line_items->data;

            foreach ($items as $item) {
                if (isset($item->price->product) && ! empty($item->price->product)) {
                    $product = $item->price->product;

                    return $product;
                    break;
                }
            }
        }

        // Return null if no product found
    }

    public static function getPromotionCode($promotionCodeId)
    {
        self::connectProvider();
        $response = self::$providerObj->promotionCodes->retrieve(
            $promotionCodeId,
            []
        );

        return $response;
    }

    public static function getOrderDiscount($payment)
    {
        $discount = [];

        if (isset($payment->total_details->breakdown->discounts) && ! empty($payment->total_details->breakdown->discounts)) {
            $discounts = $payment->total_details->breakdown->discounts;
            $discount['discount_amount'] = $payment->total_details->amount_discount / 100;

            foreach ($discounts as $discountObj) {
                $discountObj = $discountObj->discount;

                $promotionCode = PaymentHelper::getPromotionCode($discountObj->promotion_code);
                $coupon = $promotionCode->coupon;

                $discount['discount_id'] = $discountObj->id;
                $discount['coupon_code_id'] = $coupon->id;
                $discount['coupon_code'] = $coupon->name;
                $discount['promotion_code_id'] = $promotionCode->id;
                $discount['promotion_code'] = $promotionCode->code;

                $discount['amount_off'] = (! empty($coupon->amount_off) ? $coupon->amount_off : null);
                $discount['percent_off'] = (! empty($coupon->percent_off) ? $coupon->percent_off : null);
            }
        }

        return $discount;
    }
}
