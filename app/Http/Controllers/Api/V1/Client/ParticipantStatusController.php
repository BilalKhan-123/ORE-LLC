<?php

namespace App\Http\Controllers\Api\V1\Client;

use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use App\Services\ParticipantService;
use App\Http\Requests\Participant\ChangeStatus;

/**
 * @tags Participant (Client)
 */
class ParticipantStatusController extends Controller
{
    use ApiResponser;

    private $participantService;

    public function __construct(ParticipantService $participantService)
    {
        $this->participantService = $participantService;
    }

    /**
     * Participant Change Status
     */
    public function __invoke(ChangeStatus $inputs)
    {
        $data = $this->participantService->changeStatus($inputs);

        return isset($data['errors']) ? $this->error($data) : $this->success($data, 200);
    }
}
