<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\StateController;
use App\Http\Controllers\Api\V1\CountryController;
use App\Http\Controllers\Api\V1\LanguageController;
use App\Http\Controllers\Api\V1\QuestionController;
use App\Http\Controllers\Api\V1\DropdownOptionController;
use App\Http\Controllers\Api\V1\Admin\TestResultController;
use App\Http\Controllers\Api\V1\FactorExplanationConfigController;

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

// Route::post('signup', [AuthController::class, 'signUp']);
Route::post('login', [AuthController::class, 'login']);
Route::post('send-otp', [AuthController::class, 'sendOtp']);
Route::post('forget-password', [AuthController::class, 'forgetPassword']);
Route::post('reset-password', [AuthController::class, 'resetPassword']);

Route::apiResource('countries', CountryController::class)->only('index');
Route::apiResource('states', StateController::class)->only('index');

Route::apiResource('dropdown-option', DropdownOptionController::class)->only('index');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('verify-otp', [AuthController::class, 'verifyOtp']);
    Route::get('me', [UserController::class, 'me']);
    Route::post('me', [UserController::class, 'updateProfile']);
    Route::post('change-password', [AuthController::class, 'changePassword']);

    Route::get('questions', [QuestionController::class, 'index']);
    // Factros Explanation Config

    Route::Resource('factors-explanation-config', FactorExplanationConfigController::class, [
        'names' => [
            'index' => 'factors.explanation.index',
            'create' => 'factors.explanation.create',
            'store' => 'factors.explanation.store',
            'show' => 'factors.explanation.show',
            'edit' => 'factors.explanation.edit',
            'update' => 'factors.explanation.update',
            'destroy' => 'factors.explanation.destroy',
        ],
    ]);

    Route::get('admin/test/results/{test_id}/{lang?}', [TestResultController::class, 'show']);

    Route::apiResource('factors-explanation-config', FactorExplanationConfigController::class);
    Route::post('factors/explanation/config/edit/{lang}', [FactorExplanationConfigController::class, 'update'])->name('factors-explanation-config.edit');
    Route::get('factors/explanation/config/show/{lang}', [FactorExplanationConfigController::class, 'show'])->name('factors-explanation-config.edit');
    Route::delete('factors-explanation-config/destroy/{id}', [FactorExplanationConfigController::class, 'destroy'])->name('factors-explanation-config.destroy');
    // Route::post('factors/explanation/config/profile-summary/edit/{lang}', [FactorExplanationConfigController::class, 'updateProfileSummary'])->name('factors-explanation-config-profile-summary-update');

    // Route::get('factors/explanation/config/profile-summary/show/{language}', [FactorExplanationConfigController::class, 'showProfileSummary'])->name('factors-explanation-config.edit');

    Route::post('language/switch', LanguageController::class);

    Route::post('logout', [AuthController::class, 'logout']);
});
