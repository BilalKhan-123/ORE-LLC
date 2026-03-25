<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Payment;
use App\Traits\ApiResponser;
use App\Services\PaymentService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

/**
 * @tags Payment Module
 */
class PaymentController extends Controller
{
    use ApiResponser;

    public function __construct(private PaymentService $paymentService)
    {
        //
    }

    /**
     * Handle Stripe Webhook
     */
    public function handleWebhook()
    {
        // The library needs to be configured with your account's secret key.
        // Ensure the key is kept out of any version control system you might be using.
        $payload = @file_get_contents('php://input');
        $event = null;

        try {
            $event = \Stripe\Event::constructFrom(
                json_decode($payload, true)
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit();
        }

        try {
            Log::channel('stripe_webhook')->info('<===== Stripe Webhook Received Log Start =====>');

            Log::channel('stripe_webhook')->info('Type: ' . (isset($event->type) ? $event->type : '-') . ' | Payload: ' . json_encode($event->data->object));

            Log::channel('stripe_webhook')->info('<===== Stripe Webhook Received Log End =====>');

            // Handle the event
            if (in_array($event->type, ['promotion_code.created'])) {
                $promotionCode = $event->data->object;

                $data = $this->paymentService->handlePromotionCodeWebhook($event->type, $promotionCode);
            }

            return __('message.stripeWebhookSuccess');
        } catch (\Exception $e) {
            return __('message.somethingWentWrong');
        }
    }
}
