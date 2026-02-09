<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use App\Services\ParticipantService;
use App\Http\Requests\Participant\Attempt as AttemptRequest;

/**
 * @tags Participant (Admin)
 */
class ParticipantAttemptController extends Controller
{
    use ApiResponser;

    private $participantService;

    public function __construct(ParticipantService $participantService)
    {
        $this->participantService = $participantService;
    }

    /**
     * Participant Attempt
     */
    public function __invoke(AttemptRequest $request)
    {
        $data = $this->participantService->updateAllowMultipleAttempts($request->all());

        return isset($data['errors']) ? $this->error($data) : $this->success($data, 200);
    }
}
