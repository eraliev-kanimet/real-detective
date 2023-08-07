<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Http\Resources\SubcategoryResource;
use App\Models\Article;
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
        $data = $this->data(true);

        $data['category'] = new SubcategoryResource($subcategory);
        $data['articles'] = ArticleResource::collection(Article::inRandomOrder()->limit(10)->get());

        return Inertia::render('catalog/show', $data);
    }
}
