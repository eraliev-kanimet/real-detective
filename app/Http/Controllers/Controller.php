<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Page;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, SEOTools;

    protected function data(bool $isContent = false)
    {
        $site = Page::first($isContent ? ['content', 'seo'] : ['seo']);

        $content = [];

        if ($isContent) {
            $content = $site->content;

            $content['videos'] = array_map(function ($video) {
                return [
                    'preview' => asset('storage/' . $video['preview']),
                    'link' => $video['link'],
                ];
            }, $content['videos']);
        }

        return [
            'content' => $content,
            'properties' => $site->seo,
            'categories' => Category::with('subcategories:id,name,slug,category_id,contract_type,average_receipt,minimum_advance_amount,basic')
                ->whereHas('subcategories', function (Builder $query) {
                    $query->where('visible', true);
                })
                ->whereVisible(true)
                ->get()
                ->groupBy('service')
        ];
    }
}
