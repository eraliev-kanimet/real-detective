<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleShowResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $data = $this->data();

        $data['articles'] = ArticleResource::collection(Article::paginate((int) $request->get('limit', 12)));

        return Inertia::render('articles/index', $data);
    }

    public function show(Article $article)
    {
        $data = $this->data();

        $data['article'] = new ArticleShowResource($article);
        $data['articles'] = ArticleResource::collection(Article::inRandomOrder()->limit(10)->get());

        return Inertia::render('articles/show', $data);
    }
}
