<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Request as RouteRequest;
use App\Traits\ResourceFilterable;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\Resource as UserResource;
use App\Http\Resources\State\Resource as StateResource;
use App\Http\Resources\Country\Resource as CountryResource;
use App\Http\Resources\Payment\Collection as PaymentCollection;
use App\Http\Resources\ClientMetadata\Resource as ClientMetadataResource;
use App\Http\Resources\DropdownOption\Collection as DropdownOptionCollection;

class Resource extends JsonResource
{
    use ResourceFilterable;

    protected $model = 'User';

    public function toArray(Request $request): array
    {
        $data = $this->fields();
        $data['state'] = new StateResource($this->whenLoaded('state'));
        $data['country'] = new CountryResource($this->whenLoaded('country'));
        $data['client'] = new UserResource($this->whenLoaded('client'));
        //$data['describes'] = new DropdownOptionCollection($this->whenLoaded('describes'));
        //$data['major_illnesses'] = new DropdownOptionCollection($this->whenLoaded('majorIllnesses'));
        $data['role'] = $this->role;

        if (RouteRequest::is('*/me')) {
            $data['isFirstAttempt'] = $this->isFirstAttempt();
        }

        if (RouteRequest::is('*/participants')) {
            $data['is_test_attempted'] = ($this->isFirstAttempt() ? false : true);
        }

        if ($this->hasRole(config('site.roles.client'))) {
            $data['purchased_exams'] = new PaymentCollection($this->whenLoaded('purchasedExams'));
            $data['client_metadata'] = new ClientMetadataResource($this->whenLoaded('clientMetadata'));
        }

        if ($this->hasRole(config('site.roles.user'))) {
            if ($this->client()->count() > 0) {
                $data['eligible_for_cci'] = $this->eligible_for_cci;
                $data['eligible_for_cci_glycan'] = $this->eligible_for_cci_glycan;
            } else {
                $data['participant_metadata'] = $this->getParticipantMetadata();
            }
        }

        return $data;
    }
}
