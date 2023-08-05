<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Page;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, SEOTools;

    protected function data(bool $home = false)
    {
        $site = Page::first($home ? ['content', 'seo'] : ['seo']);

        return [
            'content' => $site->content,
            'properties' => $site->seo,
            'categories' => Category::with('subcategories:id,name,slug,category_id,contract_type,average_receipt,minimum_advance_amount,basic')
                ->whereVisible(true)
                ->get()
                ->groupBy('service')
        ];
    }
}
