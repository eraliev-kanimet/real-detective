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
        $data = $this->data(true);

        $this->seo()->setTitle($data['properties']['home']['title']);
        $this->seo()->setDescription($data['properties']['home']['description']);
        $this->seo()->setCanonical(route('home'));

        $data['reviews'] = Review::all();
        $data['articles'] = Article::getRandom();

        return Inertia::render('home', $data);
    }

    public function faq()
    {
        $data = $this->data(true);

        $this->seo()->setTitle($data['properties']['faq']['title']);
        $this->seo()->setDescription($data['properties']['faq']['description']);
        $this->seo()->setCanonical(route('faq'));

        return Inertia::render('faq', $data);
    }

    public function reviews(Request $request)
    {
        $data = $this->data();

        $this->seo()->setTitle($data['properties']['reviews']['title']);
        $this->seo()->setDescription($data['properties']['reviews']['description']);
        $this->seo()->setCanonical(route('reviews'));

        $data['reviews'] = Review::paginate((int) $request->get('limit', 12));

        return Inertia::render('reviews', $data);
    }

    public function contacts()
    {
        $data = $this->data();

        $this->seo()->setTitle($data['properties']['contacts']['title']);
        $this->seo()->setDescription($data['properties']['contacts']['description']);
        $this->seo()->setCanonical(route('contacts'));

        return Inertia::render('contacts', $data);
    }

    public function not_found()
    {
        $data = $this->data();

        $this->seo()->setTitle($data['properties']['not_found']['title']);
        $this->seo()->setDescription($data['properties']['not_found']['description']);

        return Inertia::render('404', $data);
    }
}
