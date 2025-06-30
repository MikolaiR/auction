<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController
{
    public function __invoke(Request $request, $locale)
    {
        // Check if the language is supported
        if (!in_array($locale, ['en', 'ru'])) {
            $locale = 'ru'; // Default to Russian if unsupported language
        }

        // Store the locale in session
        Session::put('locale', $locale);
        App::setLocale($locale);
        
        // Redirect back to the previous page
        return redirect()->back();
    }
}
