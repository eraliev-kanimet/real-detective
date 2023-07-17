<?php

namespace App\Http\Controllers;

use App\Models\Review;

class HomeController extends Controller
{
    public function home()
    {
        return view('pages.home', $this->data(true));
    }

    public function reviews()
    {
        $data = $this->data();

        $data['reviews'] = Review::paginate(12);

        return view('pages.reviews', $data);
    }

    public function contacts()
    {
        return view('pages.contacts', $this->data());
    }
}
