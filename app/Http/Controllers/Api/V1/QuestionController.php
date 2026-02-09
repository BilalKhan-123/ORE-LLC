<?php

namespace App\Http\Controllers\Api\V1;

use App\Traits\BaseModel;
use App\Traits\ApiResponser;
use App\Services\QuestionService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Question\Index;
use App\Http\Resources\Question\Collection as QuestionCollection;

class QuestionController extends Controller
{
    use ApiResponser, BaseModel;

    public function __construct(private QuestionService $questionService)
    {
        //
    }

    /**
     * Question List
     *
     * To load relationship data pass below values in `include` parameter
     * - options
     */
    public function index(Index $request)
    {
        $questions = $this->questionService->collection($request->all());

        return $this->collection(new QuestionCollection($questions));
    }
}
