<?php

namespace App\Http\Controllers;

use App\Http\Requests;

class PagesController extends Controller
{
    public function getHome()
    {
        return view('pages.home');
    }

    public function getAbout()
    {
        return view('pages.about');
    }

    public function getContact()
    {
        return view('pages.contact');
    }
}
