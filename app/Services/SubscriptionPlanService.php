<?php

namespace App\Services;

use App\Library\PaymentHelper;
use Illuminate\Support\Facades\Log;

class SubscriptionPlanService
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        $authUser = auth()->user();
        try {
            $subscriptionPlans = PaymentHelper::getPlans();
            $subscriptionPlans = array_filter($subscriptionPlans, function ($item) {
                if (isset($item['metadata']['is_multiple_for_participate'])) {
                    $item['metadata']['is_multiple_for_participate'] = ($item['metadata']['is_multiple_for_participate'] == '0') ? false : true;
                } else {
                    $item['metadata']['is_multiple_for_participate'] = false; // Default to true if not present
                }

                return $item['active'] == true;
            });

            $this->checkParticipateHasMultipleExam($subscriptionPlans);
            $subscriptionPlans = array_values($subscriptionPlans);

            $data['data'] = $subscriptionPlans;
        } catch (\Exception $e) {
            Log::info('Get subscription plan detail error : ' . $e->getMessage());

            $data['errors']['message'] = __('message.somethingWentWrong');
        }

        return $data;
    }

    /**
     * Class private method's
     */
    public function checkParticipateHasMultipleExam(array &$plans)
    {
        $authUser = auth()->user();

        if ($authUser->hasRole(config('site.roles.user'))) {
            $participantMetadata = $authUser->getParticipantMetadata();
            foreach ($plans as &$plan) {
                $planType = $plan->metadata?->plan_type;
                $metadataPlan = array_values(array_filter($participantMetadata, function ($item) use ($planType) {
                    return $item['plan_type'] == $planType;
                }));
                $metadataPlan = $metadataPlan[0] ?? null;
                $plan->participate_has_exam = $metadataPlan['is_exam_available'];
            }
        }
    }
}
