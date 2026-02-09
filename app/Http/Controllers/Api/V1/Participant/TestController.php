<?php

namespace App\Http\Controllers\Api\V1\Participant;

use App\Traits\ApiResponser;
use App\Services\TestService;
use App\Http\Requests\Test\Show;
use App\Http\Requests\Test\Index;
use App\Http\Requests\Test\Compare;
use App\Http\Controllers\Controller;
use App\Http\Requests\Test\Request as TestRequest;
use App\Http\Resources\Answer\Collection as AnswerCollection;

/**
 * @tags Participant
 */
class TestController extends Controller
{
    use ApiResponser;

    public function __construct(private TestService $testService)
    {
        //
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
     * Submit Test
     */
    public function store(TestRequest $request)
    {
        $testObj = $this->testService->store($request->all());

        return isset($testObj['errors']) ? $this->error($testObj) : $this->success($testObj, 200);
    }

    /**
     * Test Compare Show
     */
    public function compare(Compare $request)
    {
        $data = $this->testService->compare($request->all());

        return isset($data['errors']) ? $this->error($data) : $data;
    }

    // Other Functions

    /**
    * Update Scores
    */

    function updateScores()  {
        
        $testObj = $this->testService->updateScores();

        return isset($testObj['errors']) ? $this->error($testObj) : $this->success($testObj, 200);
    
    }
}
