<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Traits\ApiResponser;
use App\Services\ClientService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Attempt;

/**
 * @tags Client (Admin)
 */
class ClientAttemptController extends Controller
{
    use ApiResponser;

    private $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    /**
     * Client Attempt
     */
    public function __invoke(Attempt $request)
    {
        $data = $this->clientService->updateAllowMultipleAttempts($request->all());

        return isset($data['errors']) ? $this->error($data) : $this->success($data, 200);
    }
}
