<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    //
    public function changeLanguage($lang)
    {
        session()->has('lang') ? session()->forget('lang') : '';

        if ($lang == 'en')
        {
            session()->put('lang', 'en');
        }
        else
        {
            session()->put('lang', 'ar');
        }

        return back();
    }
}
