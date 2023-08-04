<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class PageController extends Controller
{
    public function sitemap()
    {
        return Inertia::render('sitemap', $this->data());
    }

    public function cookiesPolicy()
    {
        return Inertia::render('cookies_policy', $this->data());
    }

    public function privacyPolicy()
    {
        return Inertia::render('privacy_policy', $this->data());
    }
}
