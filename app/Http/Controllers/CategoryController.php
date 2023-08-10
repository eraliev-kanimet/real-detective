<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubcategoryResource;
use App\Models\Article;
use App\Models\Subcategory;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        $data = $this->data();

        $this->seo()->setTitle($data['properties']['services']['title']);
        $this->seo()->setDescription($data['properties']['services']['description']);
        $this->seo()->setCanonical(route('categories'));

        return Inertia::render('catalog/index', $data);
    }

    public function price()
    {
        $data = $this->data();

        $this->seo()->setTitle($data['properties']['price']['title']);
        $this->seo()->setDescription($data['properties']['price']['description']);
        $this->seo()->setCanonical(route('price'));

        return Inertia::render('catalog/price', $data);
    }

    public function subcategory(Subcategory $subcategory)
    {
        $this->seo()->setTitle($subcategory->basic['seo']['name']);
        $this->seo()->setDescription($subcategory->basic['seo']['description']);
        $this->seo()->setCanonical(route('subcategory', $subcategory));

        $data = $this->data(true);

        $data['category'] = new SubcategoryResource($subcategory);
        $data['articles'] = Article::getRandom();

        return Inertia::render('catalog/show', $data);
    }
}
