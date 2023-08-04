<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        return Inertia::render('catalog/index', $this->data());
    }

    public function price()
    {
        return Inertia::render('catalog/price', $this->data());
    }

    public function subcategory(Subcategory $subcategory)
    {
        $data = $this->data();

        $data['subcategory'] = $subcategory;

        return Inertia::render('catalog/show', $data);
    }
}
