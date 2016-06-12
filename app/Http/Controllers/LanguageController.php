<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;


    class LanguageController extends Controller
    {

        public function update($locale){
            if(Auth::check()){
                Auth::user()->locale = $locale;
                Auth::user()->save();
            }
            Lang::setLocale($locale);
    //        dd($locale);
    //        var_dump($locale);
            app()->setLocale($locale);
//            dd(app()->getLocale());
            return redirect()->back();

        }
    }
