<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Subcategory;
use Inertia\Inertia;

class PageController extends Controller
{
    public function sitemap()
    {
        $this->seo()->setCanonical(route('sitemap'));

        $data = $this->data();

        $data['services'] = Subcategory::whereVisible(true)->get(['id', 'name', 'slug']);
        $data['articles'] = Article::all(['id', 'name', 'slug']);

        return Inertia::render('sitemap', $data);
    }

    public function cookiesPolicy()
    {
        $this->seo()->setCanonical(route('cookies-policy'));

        return Inertia::render('cookies_policy', $this->data());
    }

    public function privacyPolicy()
    {
        $this->seo()->setCanonical(route('privacy-policy'));

        return Inertia::render('privacy_policy', $this->data());
    }
}
