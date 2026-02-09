<?php

namespace App\Http\Controllers\Api\V1\Participant;

use App\Traits\ApiResponser;
use App\Services\PaymentService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\Index;
use App\Http\Requests\Payment\CreateIntent;
use App\Http\Requests\Payment\Request as PaymentRequest;
use App\Http\Resources\Payment\Collection as PaymentCollection;

/**
 * @tags Participant Payment Module
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

    /**
     * Checkout Payment
     */
    public function create(CreateIntent $request)
    {
        $data = $this->paymentService->create($request->all());

        return isset($data['errors']) ? $this->error($data) : $this->success($data, 200);
    }

    /**
     * Update Payment status
     */
    public function store(PaymentRequest $request)
    {
        $data = $this->paymentService->store($request->all());

        return isset($data['errors']) ? $this->error($data) : $this->success($data, 200);
    }
}
