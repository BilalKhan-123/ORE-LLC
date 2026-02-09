<?php

namespace App\Http\Controllers\Api\V1\Client;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Services\DashboardService;
use App\Http\Controllers\Controller;

/**
 * @tags Client
 */
class DashboardController extends Controller
{
    use ApiResponser;

    private $dashboardService;

    public function __construct()
    {
        $this->dashboardService = new DashboardService;
    }

    /**
     * Client Dashboard Detail
     */
    public function __invoke(Request $request)
    {
        $dashboardData = $this->dashboardService->index($request->all());

        $data['data'] = $dashboardData;

        return $this->success($data, 200);
    }
}
