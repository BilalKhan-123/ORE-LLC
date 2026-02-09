<?php

namespace App\Http\Controllers\Api\V1;

use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use App\Services\DropdownOptionService;
use App\Http\Requests\DropdownOption\Index;

/**
 * @tags Dropdown options
 */
class DropdownOptionController extends Controller
{
    use ApiResponser;

    public function __construct(private DropdownOptionService $dropdownOptionService)
    {
        //
    }

    /**
     * Dropdown options List
     *
     * Use the following type for major illness and ethnic option:
     * - ethnic_group
     * - major_illness
     */
    public function index(Index $request)
    {
        $data['data'] = $this->dropdownOptionService->collection($request->all());

        return $this->success($data, 200);
    }
}
