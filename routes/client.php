<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Client\TestController;
use App\Http\Controllers\Api\V1\Client\ChartController;
use App\Http\Controllers\Api\V1\Client\PaymentController;
use App\Http\Controllers\Api\V1\Client\DashboardController;
use App\Http\Controllers\Api\V1\Client\TestResultController;
use App\Http\Controllers\Api\V1\Client\ParticipantController;
use App\Http\Controllers\Api\V1\Client\SubscriptionPlanController;
use App\Http\Controllers\Api\V1\Client\ParticipantStatusController;
use App\Http\Controllers\Api\V1\Client\ParticipantAttemptController;

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

Route::post('/participants', [ParticipantController::class, 'store']);

Route::group(['middleware' => ['auth:sanctum', 'role:' . config('site.roles.client')]], function () {
    Route::get('dashboard/statistics', DashboardController::class);

    Route::apiResource('participants', ParticipantController::class, ['as' => 'client.participants'])->only([
        'index', 'show', 'update', 'destroy',
    ]);

    Route::apiResource('tests', TestController::class)->only('index', 'show');
    Route::get('tests/compare/{user_id}', [TestController::class, 'compare']);

    Route::get('test/average-times', [ChartController::class, 'questionAverageTimes']);
    Route::get('test/results/{test_id}', [TestResultController::class, 'show']);
    Route::get('test/results/compare/{user_id}', [TestResultController::class, 'compare']);

    Route::post('participants/change-status', ParticipantStatusController::class, ['as' => 'client.participants.change-status']);
    Route::post('participants/allow-multiple-attempts', ParticipantAttemptController::class);

    Route::get('test/plans', [SubscriptionPlanController::class, 'index']);

    Route::post('test/checkout-payment', [PaymentController::class, 'create']);
    Route::post('test/payment-status', [PaymentController::class, 'store']);
    Route::get('test/payment/history', [PaymentController::class, 'index']);
});
