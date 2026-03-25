<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\{
    BannerController,
    AboutController,
    ServiceController,
    DepartmentController,
    FaqController,
    GalleryController,
    TestimonialController,
    ContactController,
    UserContactMessageController,
};


/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for admin authentication and pages.
| These routes are loaded by the RouteServiceProvider within a group which
| is assigned the "web" middleware group and prefixed with "/admin".
|
*/

// Authentication Routes - Guests Only
Route::group(['prefix' => 'system','middleware' => 'guest'],function () {
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    
    Route::get('register', function () { return view('register'); })->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('register.post');
    
    Route::get('password/reset', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('password/email', [AuthController::class, 'sendPasswordResetLink'])->name('password.email');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('dashboard', [AuthController::class, 'home'])->name('dashboard');
    Route::resource('banners', BannerController::class);
    Route::resource('about', AboutController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('faqs', FaqController::class);
    Route::resource('galleries', GalleryController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('contacts', ContactController::class);
    Route::resource('user-contacts', UserContactMessageController::class);
    Route::post('user-contacts/send-respond', [UserContactMessageController::class, 'sendRespond'])->name('user-contacts.send-respond');
});

