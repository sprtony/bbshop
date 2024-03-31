<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{
    public function home()
    {
        return view('pages.home.index');
    }

    public function about()
    {
        return view('pages.about.index');
    }

    public function contact()
    {
        return view('pages.contact.index');
    }
}
