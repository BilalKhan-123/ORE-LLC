<?php

namespace App\Services;

use App\Models\State;
use App\Traits\BaseModel;

class StateService
{
    use BaseModel;

    private $stateObj;

    public function __construct()
    {
        $this->stateObj = new State;
    }

    public function collection(array $inputs)
    {
        $states = $this->stateObj->getQB()->where('country_id', $inputs['country_id']);

        $inputs['limit'] = isset($inputs['limit']) ? $inputs['limit'] : config('site.paginationLimit');

        return (isset($inputs['limit']) && $inputs['limit'] == '-1') ? $states->get() : $states->paginate($inputs['limit']);
    }
}
