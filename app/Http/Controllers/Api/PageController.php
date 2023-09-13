<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleShowResource;
use App\Http\Resources\SubcategoryResource;
use App\Models\Article;
use App\Models\Category;
use App\Models\Page;
use App\Models\Review;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function page(string $page)
    {
        $validPages = [
            'cookies_policy',
            'privacy_policy',
            'about',
            'sitemap',
            'blog',
            'home',
            'faq',
            'reviews',
            'contacts',
            'services',
            'price',
        ];

        if (in_array($page, $validPages)) {
            $isContentPage = in_array($page, ['about', 'home', 'cookies_policy', 'privacy_policy', 'faq']);

            $site = Page::first($isContentPage ? ['content', 'seo'] : ['seo']);

            $data['seo'] = [
                'title' => $site->seo[$page]['title'],
                'description' => $site->seo[$page]['description'],
            ];

            if ($page == 'sitemap') {
                $page = 'home';
            }

            if ($isContentPage) {
                $content = $site->content;

                $content['videos'] = array_map(function ($video) {
                    return [
                        'preview' => asset('storage/' . $video['preview']),
                        'link' => $video['link'],
                    ];
                }, $content['videos']);

                foreach (['about', 'cookies_policy', 'privacy_policy'] as $value) {
                    if ($value != $page) {
                        unset($content[$value]);
                    }
                }

                $data['content'] = $content;
            }

            return response()->json($data);
        }

        return response()->json([
            'error' => 'Страница не найдена',
            'validPages' => $validPages
        ], 404);
    }

    public function categories()
    {
        return response()->json(Category::with('subcategories:id,name,slug,category_id,contract_type,average_receipt,minimum_advance_amount,basic')
            ->whereHas('subcategories', function (Builder $query) {
                $query->where('visible', true);
            })
            ->whereVisible(true)
            ->get()
            ->groupBy('service'));
    }

    public function services()
    {
        return response()->json(Subcategory::whereVisible(true)->get(['id', 'name', 'slug']));
    }

    public function service(Subcategory $subcategory)
    {
        return new SubcategoryResource($subcategory);
    }

    public function articles(Request $request)
    {
        return ArticleResource::collection(Article::paginate(
            (int)$request->get('limit', 12),
            ['id', 'slug', 'name', 'description', 'tags', 'image', 'updated_at']
        ));
    }

    public function article(Article $article)
    {
        return new ArticleShowResource($article);
    }

    public function reviews(Request $request)
    {
        return response()->json(Review::paginate($request->get('limit', 12)));
    }
}
