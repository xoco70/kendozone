<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class LanguageController extends Controller
    {

        public function update($locale)
        {
            if (Auth::check()) {
                Auth::user()->locale = $locale;
                Auth::user()->save();
            }
            Session::put('locale', $locale);
            return redirect()->back();


        }
    }
