<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ParticipantService;
use App\Http\Requests\Participant\Index;
use App\Http\Resources\User\Resource as UserResource;
use App\Http\Resources\User\Collection as UserCollection;
use App\Http\Requests\Participant\Request as ParticipantRequest;

/**
 * @tags Participant (Admin)
 */
class ParticipantController extends Controller
{
    use ApiResponser;

    private $participantService;

    public function __construct(ParticipantService $participantService)
    {
        $this->participantService = $participantService;
    }

    /**
     * Participant List
     *
     * To load relationship data pass below values in `include` parameter
     * - client
     */
    public function index(Index $request)
    {
        $participants = $this->participantService->collection($request->all());

        return $this->collection(new UserCollection($participants));
    }

    /**
     * Create Participant
     */
    public function store(ParticipantRequest $request)
    {
        $participantObj = $this->participantService->store($request->all());

        return isset($participantObj['errors']) ? $this->error($participantObj) : $this->success($participantObj, 200);
    }

    /**
     * Show Participant
     *
     * To load relationship data pass below values in `include` parameter
     * - describes
     * - majorIllnesses
     */
    public function show($userId, Request $request)
    {
        $participantObj = $this->participantService->resource($userId, $request->all());

        return isset($participantObj['errors']) ? $this->error($participantObj) : new UserResource($participantObj);
    }

    /**
     * Update Participant
     */
    public function update($userId, ParticipantRequest $request)
    {
        $participantObj = $this->participantService->update($userId, $request->all());

        return isset($participantObj['errors']) ? $this->error($participantObj) : $this->success($participantObj, 200);
    }

    /**
     * Delete Participant
     */
    public function destroy($userId)
    {
        $participantObj = $this->participantService->destroy($userId);

        return $this->success($participantObj, 200);
    }
}
