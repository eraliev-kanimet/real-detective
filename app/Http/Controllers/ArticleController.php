<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $data = $this->data();

        $articles = Article::paginate((int) $request->get('limit', 12));

        foreach ($articles->items() as $article) {
            $article->image = asset('storage/' . $article->image);
            $article->name = Str::words($article->description, 5);
            $article->description = Str::words($article->description, 25);
        }

        $data['articles'] = $articles;

        return Inertia::render('articles/index', $data);
    }

    public function show(Article $article)
    {
        $data = $this->data();

        $data['article'] = $article;

        return Inertia::render('articles/show', $data);
    }
}
