<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\LanguageController;
//use App\Http\Controllers\Site\PaymentController;
//use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');

//Route::group(['middleware' => 'guest'],function () {

    Route::get('/', [SiteController::class, 'siteIndex'])->name('home');
    Route::get('/about', [SiteController::class, 'siteAbout'])->name('site.about');
    Route::get('/contact', [SiteController::class, 'siteContact'])->name('site.contact');
    Route::get('/terms', [SiteController::class, 'siteTerms'])->name('site.terms');
    Route::get('/privacy', [SiteController::class, 'sitePrivacy'])->name('site.privacy');
    Route::get('/services', [SiteController::class, 'siteServices'])->name('site.services');
    Route::get('/services/{slug}', [SiteController::class, 'siteServicesDetails'])->name('site.services.details');
    Route::get('/featured-services', [SiteController::class, 'siteFeaturedServices'])->name('site.services.featured');
    Route::get('/faqs', [SiteController::class, 'siteFaqs'])->name('site.faqs');
    Route::get('/support', [SiteController::class, 'siteSupport'])->name('site.support');
    Route::get('/departments', [SiteController::class, 'siteDepartments'])->name('site.departments');
    Route::get('/departments/{slug}', [SiteController::class, 'siteDepartmentsDetails'])->name('site.departments.details');
    Route::get('/testimonials', [SiteController::class, 'siteTestimonial'])->name('site.testimonials');

//});


// Stripe Webhook Route
Route::post('stripe/webhook', [PaymentController::class, 'handleWebhook']);
