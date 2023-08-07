<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Subcategory;
use Inertia\Inertia;

class PageController extends Controller
{
    public function sitemap()
    {
        $data = $this->data();

        $data['services'] = Subcategory::whereVisible(true)->get();
        $data['articles'] = Article::all();

        return Inertia::render('sitemap', $data);
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
