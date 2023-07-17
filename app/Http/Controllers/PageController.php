<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function sitemap()
    {
        return view('pages.sitemap', $this->data());
    }

    public function cookiesPolicy()
    {
        return view('pages.cookies', $this->data());
    }

    public function privacyPolicy()
    {
        return view('pages.privacy', $this->data());
    }
}
