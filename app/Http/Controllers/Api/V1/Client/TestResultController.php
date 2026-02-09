<?php

namespace App\Http\Controllers\Api\V1\Client;

use App\Traits\ApiResponser;
use App\Services\TestResultService;
use App\Http\Controllers\Controller;
use App\Http\Requests\TestResult\Show;
use App\Http\Requests\TestResult\Compare;

/**
 * @tags Client
 */
class TestResultController extends Controller
{
    use ApiResponser;

    public function __construct(private TestResultService $testResultService)
    {
        //
    }

    /**
     * Test Result Show
     */
    public function show(Show $request)
    {
        $data = $this->testResultService->resource($request->all());

        return isset($data['errors']) ? $this->error($data) : $data;
    }

    /**
     * Test Compare Result Show
     */
    public function compare(Compare $request)
    {
        $data = $this->testResultService->compare($request->all());

        return isset($data['errors']) ? $this->error($data) : $data;
    }
}
