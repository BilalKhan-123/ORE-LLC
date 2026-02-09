<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Admin\TestController;
use App\Http\Controllers\Api\V1\Admin\ChartController;
use App\Http\Controllers\Api\V1\Admin\ClientController;
use App\Http\Controllers\Api\V1\Admin\PaymentController;
use App\Http\Controllers\Api\V1\Admin\DashboardController;
use App\Http\Controllers\Api\V1\Admin\TestResultController;
use App\Http\Controllers\Api\V1\Admin\ParticipantController;
use App\Http\Controllers\Api\V1\Admin\ClientStatusController;
use App\Http\Controllers\Api\V1\Admin\ClientAttemptController;
use App\Http\Controllers\Api\V1\Admin\ParticipantStatusController;
use App\Http\Controllers\Api\V1\Admin\ParticipantAttemptController;
use App\Http\Controllers\Api\V1\Participant\TestController as ParticipantTestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['auth:sanctum', 'role:' . config('site.roles.admin')]], function () {
    Route::get('dashboard/statistics', DashboardController::class);

    Route::apiResource('tests', TestController::class)->only('index', 'show');
    Route::get('tests/compare/{user_id}', [TestController::class, 'compare']);

    Route::apiResource('clients', ClientController::class, ['as' => 'admin.clients']);
    Route::post('clients/change-status', ClientStatusController::class);

   //Route::get('test/results/{test_id}/{lang?}', [TestResultController::class, 'show']);

    //Route::get('test/results/{test_id}', [TestResultController::class, 'show']);
    Route::get('test/results/factors/{flag}/{lang?}', [TestResultController::class, 'showFactors']);
    Route::get('test/results/compare/{user_id}', [TestResultController::class, 'compare']);
    Route::get('test/average-times', [ChartController::class, 'questionAverageTimes']);

    //Route::get('test/results/{test_id}/{lang?}', [TestResultController::class, 'show']);
    Route::get('test/results/{test_id}/{lang?}', [TestResultController::class, 'show'])
    ->where('test_id', '[0-9]+');

    Route::apiResource('participants', ParticipantController::class, ['as' => 'admin.participants']);
    Route::post('update/participants/score', [ParticipantTestController::class, 'updateScores']);
    Route::post('participants/change-status', ParticipantStatusController::class);
    Route::post('clients/allow-multiple-attempts', ClientAttemptController::class);
    Route::post('participants/allow-multiple-attempts', ParticipantAttemptController::class);
    Route::get('test/payment/history', [PaymentController::class, 'index']);
});
