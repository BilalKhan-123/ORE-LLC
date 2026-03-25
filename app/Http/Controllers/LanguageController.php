<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LanguageController extends Controller
{
    /**
     * Switch application language for guest users.
     */
    public function switch($locale, Request $request)
    {
        $allowed = ['en', 'de'];
        if (! in_array($locale, $allowed)) {
            $locale = config('app.locale');
        }

        // store in session so selection persists for guests
        $request->session()->put('locale', $locale);

        // optionally set a cookie for longer persistence (30 days)
        return Redirect::back();
    }
}


// namespace App\Http\Controllers\Admin;

// use App\Traits\ApiResponser;
// use App\Services\AuthService;
// use App\Http\Controllers\Controller;
// use App\Http\Requests\Auth\SwitchLanguage;

// /**
//  * @tags Auth
//  */
// class LanguageController extends Controller
// {
//     use ApiResponser;

//     public function __construct(private AuthService $authService)
//     {
//         //
//     }

//     /**
//      * Switch Language
//      */
//     public function __invoke(SwitchLanguage $request)
//     {
//         $data = $this->authService->switchLanguage($request->all());

//         return isset($data['errors']) ? $this->error($data) : $this->success($data, 200);
//     }
// }
