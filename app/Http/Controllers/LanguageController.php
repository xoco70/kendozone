<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;


class LanguageController extends Controller
{

    public function change($locale){
        if(Auth::check()){
            Auth::user()->locale = $locale;
            Auth::user()->save();
            Lang::setLocale($locale);

        }else{
            Session::put('locale',$locale);
        }

        return redirect()->back();

    }
}
