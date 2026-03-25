<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Traits\ApiResponser;
use App\Services\PaymentService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\Index;
use App\Http\Resources\Payment\Collection as PaymentCollection;

/**
 * @tags Admin Payment Module
 */
class PaymentController extends Controller
{
    use ApiResponser;

    public function __construct(private PaymentService $paymentService)
    {
        //
    }

    /**
     * Get Payment History
     */
    public function index(Index $request)
    {
        $paymentHistories = $this->paymentService->collection($request->all());

        return $this->collection(new PaymentCollection($paymentHistories));
    }
}
