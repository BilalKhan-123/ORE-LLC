<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Traits\ApiResponser;
use App\Services\ClientService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ChangeStatus;

/**
 * @tags Client
 */
class ClientStatusController extends Controller
{
    use ApiResponser;

    private $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    /**
     * Client Change Status
     */
    public function __invoke(ChangeStatus $inputs)
    {
        $data = $this->clientService->changeStatus($inputs);

        return isset($data['errors']) ? $this->error($data) : $this->success($data, 200);
    }
}
