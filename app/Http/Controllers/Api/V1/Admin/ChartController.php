<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Services\ChartService;
use App\Http\Controllers\Controller;

/**
 * @tags Admin
 */
class ChartController extends Controller
{
    use ApiResponser;

    public function __construct(private ChartService $chartService)
    {
        //
    }

    /**
     * Question Average Time
     */
    public function questionAverageTimes(Request $request)
    {
        $averageTimes = $this->chartService->questionAverageTimes($request->all());

        return $averageTimes;
    }
}
