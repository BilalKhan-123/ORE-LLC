<?php

namespace App\Http\Controllers\Api\V1;

use App\Services\StateService;
use App\Http\Controllers\Controller;
use App\Http\Requests\State\Request as StateRequest;
use App\Http\Resources\State\Collection as StateCollection;

class StateController extends Controller
{
    private $stateService;

    public function __construct()
    {
        $this->stateService = new StateService;
    }

    public function index(StateRequest $request)
    {
        $data = $this->stateService->collection($request->all());

        return new StateCollection($data);
    }
}
