<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Review;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function home()
    {
        $this->seo()->setCanonical(route('home'));

        $data = $this->data(true);

        $data['reviews'] = Review::all();
        $data['articles'] = Article::getRandom();

        return Inertia::render('home', $data);
    }

    public function faq()
    {
        $this->seo()->setCanonical(route('faq'));

        return Inertia::render('faq', $this->data(true));
    }

    public function reviews(Request $request)
    {
        $this->seo()->setCanonical(route('reviews'));

        $data = $this->data();

        $data['reviews'] = Review::paginate((int) $request->get('limit', 12));

        return Inertia::render('reviews', $data);
    }

    public function contacts()
    {
        $this->seo()->setCanonical(route('contacts'));

        return Inertia::render('contacts', $this->data());
    }

    public function not_found()
    {
        return Inertia::render('404', $this->data());
    }
}
