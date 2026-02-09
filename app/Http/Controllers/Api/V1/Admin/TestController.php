<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Traits\ApiResponser;
use App\Services\TestService;
use App\Http\Requests\Test\Show;
use App\Http\Requests\Test\Index;
use App\Http\Requests\Test\Compare;
use App\Http\Controllers\Controller;
use App\Http\Resources\Answer\Collection as AnswerCollection;

/**
 * @tags Admin
 */
class TestController extends Controller
{
    private $testService;

    use ApiResponser;

    public function __construct(TestService $testService)
    {
        $this->testService = $testService;
    }

    /**
     * Test List
     *
     * To load relationship data pass below values in `include` parameter
     * - user
     */
    public function index(Index $request)
    {
        $tests = $this->testService->collection($request->all());

        return $this->collection(new AnswerCollection($tests));
    }

    /**
     * Test Detail Show
     */
    public function show(Show $request)
    {
        $data = $this->testService->resource($request->all());

        return isset($data['errors']) ? $this->error($data) : $data;
    }

    /**
     * Test Compare Show
     */
    public function compare(Compare $request)
    {
        $data = $this->testService->compare($request->all());

        return isset($data['errors']) ? $this->error($data) : $data;
    }
}
