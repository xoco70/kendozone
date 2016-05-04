<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;


class LanguageController extends Controller
{

    public function change($locale){
        Session::put('locale',$locale);
        if(Auth::check()){
            Auth::user()->locale = $locale;
            Auth::user()->save();
            Lang::setLocale($locale);

        }

        return redirect()->back();

    }
}
