<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;

class CategoryController extends Controller
{
    public function index()
    {
        return view('pages.categories.index', $this->data());
    }

    public function price()
    {
        return view('pages.categories.price', $this->data());
    }

    public function subcategory(Subcategory $subcategory)
    {
        $data = $this->data();

        $data['subcategory'] = $subcategory;

        return view('pages.articles.index', $data);
    }
}
