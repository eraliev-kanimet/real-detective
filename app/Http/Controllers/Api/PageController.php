<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexPaginateRequest;
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
use Illuminate\Validation\Rule;

class PageController extends Controller
{
    protected array $valid = [
        'cookies_policy',
        'privacy_policy',
        'about',
        'sitemap',
        'blog',
        'article',
        'home',
        'faq',
        'reviews',
        'contacts',
        'services',
        'service',
        'price',
        'not_found',
    ];

    protected function dataApi(string $page, array $data)
    {
        $isContentPage = in_array($page, ['about', 'home', 'cookies_policy', 'privacy_policy', 'faq', 'price', 'service']);

        if (in_array($page, ['sitemap', 'not_found', 'service', 'article'])) {
            $page = 'home';
        }

        $common = Page::first();

        $data['properties'] = [
            'title' => $common->seo[$page]['title'],
            'description' => $common->seo[$page]['description'],
            'phone' => $common->seo['phone'],
            'address' => $common->seo['address'],
            'email' => $common->seo['email'],
            'telegram' => $common->seo['telegram'],
            'youtube' => $common->seo['youtube'],
            'profi' => $common->seo['profi'],
            'tenchat' => $common->seo['tenchat'],
            'whatsapp' => $common->seo['whatsapp'],
            'signal' => $common->seo['signal'],
            'reviews2' => $common->seo['reviews2'],
            'map' => $common->seo['map'],
        ];

        $data['categories'] = Category::with('subcategories:id,name,slug,category_id,contract_type,average_receipt,minimum_advance_amount,basic')
            ->whereHas('subcategories', function (Builder $query) {
                $query->where('visible', true);
            })
            ->whereVisible(true)
            ->get()
            ->groupBy('service');

        if ($isContentPage) {
            $content = $common->content;

            if ($page != 'price') {
                $content['videos'] = array_map(function ($video) {
                    return [
                        'preview' => asset('storage/' . $video['preview']),
                        'link' => $video['link'],
                    ];
                }, $content['videos']);

                foreach (['about', 'cookies_policy', 'privacy_policy',] as $value) {
                    if ($value != $page) {
                        unset($content[$value]);
                    }
                }

                $data['content'] = $content;
            } else {
                $data['content'][$page] = $content[$page];
            }
        }

        return $data;
    }

    public function page(Request $request)
    {
        $request->validate([
            'page' => ['required', Rule::in($this->valid)],
            'slug' => ['nullable', 'string'],
        ]);

        $page = $request->get('page');

        $data = $this->dataApi($page, []);

        if ($page == 'home') {
            $data['reviews'] = Review::all();
            $data['articles'] = Article::getRandom();
        }

        if ($page == 'service') {
            $service = Subcategory::whereSlug($request->get('slug'))->first();

            if ($service) {
                $data['service'] = new SubcategoryResource($service);
                $data['articles'] = Article::getRandom();

                $data['properties']['title'] = $service->basic['seo']['name'];
                $data['properties']['description'] = $service->basic['seo']['description'];
            }
        }

        if ($page == 'article') {
            $article = Article::whereSlug($request->get('slug'))->first();

            if ($article) {
                $data['article'] = new ArticleShowResource($article);
                $data['articles'] = Article::getRandom();

                $data['properties']['title'] = $article->seo['name'];
                $data['properties']['description'] = $article->seo['description'];
            }
        }

        if ($page == 'sitemap') {
            $data['services'] = Subcategory::whereVisible(true)->get(['id', 'name', 'slug']);
            $data['articles'] = Article::all(['id', 'name', 'slug']);
        }

        return response()->json($data);
    }

    public function reviews(IndexPaginateRequest $request)
    {
        return response()->json(Review::paginate((int)$request->get('limit', 12)));
    }

    public function articles(IndexPaginateRequest $request)
    {
        return ArticleResource::collection(Article::paginate(
            (int)$request->get('limit', 12),
            ['id', 'slug', 'name', 'description', 'tags', 'image', 'updated_at']
        ));
    }
}
