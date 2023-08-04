<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function home()
    {
        return Inertia::render('home', $this->data(true));
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
