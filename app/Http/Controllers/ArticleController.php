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

        $this->seo()->setTitle($data['properties']['blog']['title']);
        $this->seo()->setDescription($data['properties']['blog']['description']);
        $this->seo()->setCanonical(route('articles'));

        $data['articles'] = ArticleResource::collection(Article::paginate(
            (int) $request->get('limit', 12),
            ['id', 'slug', 'name', 'description', 'tags', 'image', 'updated_at']
        ));

        return Inertia::render('articles/index', $data);
    }

    public function show(Article $article)
    {
        $this->seo()->setTitle($article->seo['name']);
        $this->seo()->setDescription($article->seo['description']);
        $this->seo()->setCanonical(route('article', $article));

        $data = $this->data();

        $data['article'] = new ArticleShowResource($article);
        $data['articles'] = Article::getRandom();

        return Inertia::render('articles/show', $data);
    }
}
