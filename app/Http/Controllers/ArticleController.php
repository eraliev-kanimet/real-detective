<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Inertia\Inertia;

class ArticleController extends Controller
{
    public function index()
    {
        $data = $this->data();

        $data['articles'] = Article::paginate(9);

        return Inertia::render('articles/index', $data);
    }

    public function show(Article $article)
    {
        $data = $this->data();

        $data['article'] = $article;

        return Inertia::render('articles/show', $data);
    }
}
