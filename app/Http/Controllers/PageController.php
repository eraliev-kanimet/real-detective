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

        $this->seo()->setTitle($data['properties']['home']['title']);
        $this->seo()->setDescription($data['properties']['home']['description']);
        $this->seo()->setCanonical(route('sitemap'));

        $data['services'] = Subcategory::whereVisible(true)->get(['id', 'name', 'slug']);
        $data['articles'] = Article::all(['id', 'name', 'slug']);

        return Inertia::render('sitemap', $data);
    }

    public function cookiesPolicy()
    {
        $data = $this->data(true);

        $this->seo()->setTitle($data['properties']['cookies_policy']['title']);
        $this->seo()->setDescription($data['properties']['cookies_policy']['description']);
        $this->seo()->setCanonical(route('cookies-policy'));

        return Inertia::render('cookies_policy', $data);
    }

    public function privacyPolicy()
    {
        $data = $this->data(true);

        $this->seo()->setTitle($data['properties']['privacy_policy']['title']);
        $this->seo()->setDescription($data['properties']['privacy_policy']['description']);
        $this->seo()->setCanonical(route('privacy-policy'));

        return Inertia::render('privacy_policy', $data);
    }
}
