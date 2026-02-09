<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SetUserLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // // Check if the user is authenticated
        // if (Auth::check()) {
        //     // Get the user's language preference from the database
        //     $userLanguage = Auth::user()->language;

        //     // Set the application locale based on the user's preference
        //     App::setLocale($userLanguage);
        // } elseif (! empty($request->lang)) {
        //     // Set the application locale based on the user's preference
        //     App::setLocale($request->lang);
        // }

        // return $next($request);

         $locale = $request->header('X-Locale') // from Vue headers
            ?? $request->get('lang')           // from query string
            ?? (auth()->check() ? auth()->user()->language : null)
            ?? config('app.locale');           // fallback

        App::setLocale($locale);

        return $next($request);
    }
}
