<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // If session has locale, use it
        if (Session::has('locale')) {
            $locale = Session::get('locale');
        } else {
            // Default to Russian
            $locale = 'ru';
            Session::put('locale', $locale);
        }
        
        // Set the application locale
        App::setLocale($locale);
        
        return $next($request);
    }
}
