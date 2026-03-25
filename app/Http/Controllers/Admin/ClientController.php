<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Services\ClientService;
use App\Http\Requests\Client\Index;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\Resource as UserResource;
use App\Http\Requests\Client\Request as ClientRequest;
use App\Http\Resources\User\Collection as UserCollection;

/**
 * @tags Client
 */
class ClientController extends Controller
{
    use ApiResponser;

    private $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    /**
     * Client List
     */
    public function index(Index $request)
    {
        $clients = $this->clientService->collection($request->all());

        return $this->collection(new UserCollection($clients));
    }

    /**
     * Create Client
     */
    public function store(ClientRequest $request)
    {
        $clientObj = $this->clientService->store($request->all());

        return isset($clientObj['errors']) ? $this->error($clientObj) : $this->success($clientObj, 200);
    }

    /**
     * Show Client
     */
    public function show($userId, Request $request)
    {
        $clientObj = $this->clientService->resource($userId, $request->all());

        return isset($clientObj['errors']) ? $this->error($clientObj) : new UserResource($clientObj);
    }

    /**
     * Update Client
     */
    public function update($userId, ClientRequest $request)
    {
        $clientObj = $this->clientService->update($userId, $request->all());

        return isset($clientObj['errors']) ? $this->error($clientObj) : $this->success($clientObj, 200);
    }

    /**
     * Delete Client
     */
    public function destroy($userId)
    {
        $clientObj = $this->clientService->destroy($userId);

        return $this->success($clientObj, 200);
    }
}
