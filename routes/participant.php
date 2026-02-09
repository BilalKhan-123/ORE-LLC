<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Participant\AuthController;
use App\Http\Controllers\Api\V1\Participant\TestController;
use App\Http\Controllers\Api\V1\Participant\PaymentController;
use App\Http\Controllers\Api\V1\Participant\TestResultController;
use App\Http\Controllers\Api\V1\Participant\SubscriptionPlanController;

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

Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum', 'role:' . config('site.roles.user')]], function () {
    Route::get('tests/compare', [TestController::class, 'compare']);
    Route::apiResource('tests', TestController::class)->only('index', 'show', 'store');

    Route::get('test/results/{test_id}/{lang?}', [TestResultController::class, 'show']);
    Route::get('results/compare/factors/{flag}/{lang?}', [TestResultController::class, 'showFactors']);
    Route::get('test/results/compare/{user_id}', [TestResultController::class, 'compare']);

    Route::get('test/plans', [SubscriptionPlanController::class, 'index']);

    Route::post('test/checkout-payment', [PaymentController::class, 'create']);
    Route::post('test/payment-status', [PaymentController::class, 'store']);
    Route::get('test/payment/history', [PaymentController::class, 'index']);
});

// Route::get('test/generate/pdf/{id}', [TestResultController::class, 'generatepdf']);
//Route::get('test/generate/pdf/{id}', [TestController::class, 'store']);
