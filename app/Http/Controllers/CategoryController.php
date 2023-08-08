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
        $this->seo()->setTitle('Каталог');
        $this->seo()->setDescription('Каталог услуг');
        $this->seo()->setCanonical(route('categories'));

        return Inertia::render('catalog/index', $this->data(false, false));
    }

    public function price()
    {
        $this->seo()->setTitle('Цены');
        $this->seo()->setDescription('Цены на услуг');
        $this->seo()->setCanonical(route('price'));

        return Inertia::render('catalog/price', $this->data(false, false));
    }

    public function subcategory(Subcategory $subcategory)
    {
        $this->seo()->setTitle($subcategory->name);
        $this->seo()->setDescription($subcategory->basic['description']);
        $this->seo()->setCanonical(route('subcategory', $subcategory));

        $data = $this->data(true, false);

        $data['category'] = new SubcategoryResource($subcategory);
        $data['articles'] = Article::getRandom();

        return Inertia::render('catalog/show', $data);
    }
}
