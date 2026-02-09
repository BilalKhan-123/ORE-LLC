<?php

namespace App\Http\Controllers\Api\V1\Client;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\SubscriptionPlanService;

/**
 * @tags Client Payment Module
 */
class SubscriptionPlanController extends Controller
{
    use ApiResponser;

    public function __construct(private SubscriptionPlanService $subscriptionPlanService)
    {
        //
    }

    /**
     * Get Plans
     */
    public function index(Request $request)
    {
        $data = $this->subscriptionPlanService->index($request->all());

        return isset($data['errors']) ? $this->error($data) : $this->success($data, 200);
    }
}
