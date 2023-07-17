<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $data = $this->data();

        $data['articles'] = Article::paginate(9);

        return view('pages.articles.index', $data);
    }

    public function show(Article $article)
    {
        $data = $this->data();

        $data['article'] = $article;

        return view('pages.articles.show', $data);
    }
}
