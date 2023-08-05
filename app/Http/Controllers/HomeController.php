<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Review;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function home()
    {
        $data = $this->data(true);

        $data['reviews'] = Review::all();
        $data['articles'] = Article::format(Article::limit(10)->get());

        return Inertia::render('home', $data);
    }

    public function faq()
    {
        return Inertia::render('faq', $this->data(true));
    }

    public function reviews()
    {
        $data = $this->data();

        $data['reviews'] = Review::paginate(12);

        return Inertia::render('reviews', $data);
    }

    public function contacts()
    {
        return Inertia::render('contacts', $this->data());
    }

    public function not_found()
    {
        return Inertia::render('404', $this->data());
    }
}
