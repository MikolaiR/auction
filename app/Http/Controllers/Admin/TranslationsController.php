<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class TranslationsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin_web');
        $this->middleware('ensure.account.active');
    }
    
    /**
     * Display a listing of translations.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Load translation files
        $enTranslations = $this->loadTranslations('en');
        $ruTranslations = $this->loadTranslations('ru');
        
        // Create a merged list of all keys from both files
        $allKeys = array_unique(array_merge(array_keys($enTranslations), array_keys($ruTranslations)));
        sort($allKeys);
        
        // Create a combined array with keys and translations
        $translations = [];
        foreach ($allKeys as $key) {
            $translations[$key] = [
                'key' => $key,
                'en' => $enTranslations[$key] ?? '',
                'ru' => $ruTranslations[$key] ?? ''
            ];
        }
        
        return view('translations.admin.index', compact('translations'));
    }
    
    /**
     * Show the form for creating a new translation.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('translations.admin.create');
    }
    
    /**
     * Store a newly created translation in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'key' => 'required|string',
            'en' => 'required|string',
            'ru' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $key = $request->input('key');
        $enTranslation = $request->input('en');
        $ruTranslation = $request->input('ru');

        // Add to both language files
        $this->updateTranslation('en', $key, $enTranslation);
        $this->updateTranslation('ru', $key, $ruTranslation);

        return redirect()->route('admin.translations.index')
            ->with('success', __('Translation added successfully.'));
    }
    
    /**
     * Show the form for editing the specified translation.
     *
     * @param  string  $key
     * @return \Illuminate\View\View
     */
    public function edit($key)
    {
        $key = urldecode($key);
        $enTranslations = $this->loadTranslations('en');
        $ruTranslations = $this->loadTranslations('ru');
        
        $translation = [
            'key' => $key,
            'en' => $enTranslations[$key] ?? '',
            'ru' => $ruTranslations[$key] ?? ''
        ];
        
        return view('translations.admin.edit', compact('translation'));
    }
    
    /**
     * Update the specified translation in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $key
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $key)
    {
        $key = urldecode($key);
        
        $validator = Validator::make($request->all(), [
            'en' => 'required|string',
            'ru' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $enTranslation = $request->input('en');
        $ruTranslation = $request->input('ru');

        // Update both language files
        $this->updateTranslation('en', $key, $enTranslation);
        $this->updateTranslation('ru', $key, $ruTranslation);

        return redirect()->route('admin.translations.index')
            ->with('success', __('Translation updated successfully.'));
    }
    
    /**
     * Remove the specified translation from storage.
     *
     * @param  string  $key
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($key)
    {
        $key = urldecode($key);
        
        // Remove from both language files
        $this->removeTranslation('en', $key);
        $this->removeTranslation('ru', $key);
        
        return redirect()->route('admin.translations.index')
            ->with('success', __('Translation deleted successfully.'));
    }
    
    /**
     * Load translations from a specific language file.
     *
     * @param  string  $lang
     * @return array
     */
    private function loadTranslations($lang)
    {
        $path = resource_path("lang/{$lang}.json");
        if (File::exists($path)) {
            $content = File::get($path);
            return json_decode($content, true) ?? [];
        }
        
        return [];
    }
    
    /**
     * Update a translation in a specific language file.
     *
     * @param  string  $lang
     * @param  string  $key
     * @param  string  $value
     * @return void
     */
    private function updateTranslation($lang, $key, $value)
    {
        $path = resource_path("lang/{$lang}.json");
        $translations = $this->loadTranslations($lang);
        
        $translations[$key] = $value;
        
        // Write back to the file with JSON_PRETTY_PRINT to maintain readability
        File::put($path, json_encode($translations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
    
    /**
     * Remove a translation from a specific language file.
     *
     * @param  string  $lang
     * @param  string  $key
     * @return void
     */
    private function removeTranslation($lang, $key)
    {
        $path = resource_path("lang/{$lang}.json");
        $translations = $this->loadTranslations($lang);
        
        if (isset($translations[$key])) {
            unset($translations[$key]);
            
            // Write back to the file
            File::put($path, json_encode($translations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
    }
}
