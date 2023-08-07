<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\Review;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function home()
    {
        $data = $this->data(true);

        $data['reviews'] = Review::all();
        $data['articles'] = ArticleResource::collection(Article::inRandomOrder()->limit(10)->get());

        return Inertia::render('home', $data);
    }

    public function faq()
    {
        return Inertia::render('faq', $this->data(true));
    }

    public function reviews(Request $request)
    {
        $data = $this->data();

        $data['reviews'] = Review::paginate((int) $request->get('limit', 12));

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
