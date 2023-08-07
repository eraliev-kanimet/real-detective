<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Subcategory;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapCommand extends Command
{
    protected $signature = 'sitemap:generate';

    public function handle(): void
    {
        Sitemap::create()
            ->add(Url::create(route('home')))
            ->add(Url::create(route('sitemap')))
            ->add(Url::create(route('faq')))
            ->add(Url::create(route('reviews')))
            ->add(Url::create(route('contacts')))
            ->add(Url::create(route('articles')))
            ->add(Url::create(route('categories')))
            ->add(Url::create(route('price')))
            ->add(Url::create(route('cookies-policy')))
            ->add(Url::create(route('privacy-policy')))
            ->add(Subcategory::whereVisible(true)->get())
            ->add(Article::all())
            ->writeToFile(public_path('sitemap.xml'));
    }
}
