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
        $this->seo()->setTitle('Статьи');
        $this->seo()->setDescription('Статьи Детективного Агентства');
        $this->seo()->setCanonical(route('articles'));

        $data = $this->data(false, false);

        $data['articles'] = ArticleResource::collection(Article::paginate(
            (int) $request->get('limit', 12),
            ['id', 'slug', 'name', 'description', 'tags', 'image', 'updated_at']
        ));

        return Inertia::render('articles/index', $data);
    }

    public function show(Article $article)
    {
        $this->seo()->setTitle($article->name);
        $this->seo()->setDescription($article->description);
        $this->seo()->setCanonical(route('article', $article));

        $data = $this->data(false, false);

        $data['article'] = new ArticleShowResource($article);
        $data['articles'] = Article::getRandom();

        return Inertia::render('articles/show', $data);
    }
}
