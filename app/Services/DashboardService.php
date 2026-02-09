<?php

namespace App\Services;

use App\Models\User;
use App\Models\ClientMetadata;
use App\Http\Resources\ClientMetadata\Resource as ClientMetadataResource;

class DashboardService
{
    private $userObj;

    public function __construct()
    {
        $this->userObj = new User;
    }

    public function index($inputs)
    {
        $clientCount = 0;
        $participantCount = 0;
        $auth = auth()->user();
        $clientMetadata = [];
        $cciCountData = [];

        if ($auth->hasRole(config('site.roles.admin'))) {
            $clientCount = $this->userObj->role(config('site.roles.client'))
                ->count();

            $participantCount = $this->userObj->role(config('site.roles.user'))
                ->count();

             $clientMetadata['client_metadata']  = [
                'conducted_cci_count' => ClientMetadata::sum('conducted_cci_count'),
                'conducted_cci_plus_count' => ClientMetadata::sum('conducted_cci_plus_count'),
                'conducted_cci_consultation_count' => ClientMetadata::sum('conducted_cci_consultation_count'),
                'conducted_glycan_count' => ClientMetadata::sum('conducted_glycan_count'),
                'total_cci_count' => ClientMetadata::sum('total_cci_count'),
                'total_cci_plus_count' => ClientMetadata::sum('total_cci_plus_count'),
                'total_cci_consultation_count' => ClientMetadata::sum('total_cci_consultation_count'),
                'total_glycan_count' => ClientMetadata::sum('total_glycan_count'),
            ];

        }

        if ($auth->hasRole(config('site.roles.client'))) {
            $metadata = $auth->clientMetadata;
            $clientMetadata['client_metadata'] = new ClientMetadataResource($metadata);
            $participantCount = $metadata->number_of_participants;
        }

        $data = [
            'clientCount' => $clientCount,
            'participantCount' => $participantCount,
            'cciCountData,' => $cciCountData,
            ...$clientMetadata,
        ];

        return $data;
    }
}
