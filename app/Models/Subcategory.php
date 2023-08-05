<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sitemap\Contracts\Sitemapable;

class Subcategory extends Model implements Sitemapable
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'visible',
        'contract_type',
        'average_receipt',
        'minimum_advance_amount',
        'basic',
        'content',
        'faq',
    ];

    protected $casts = [
        'basic' => 'array',
        'content' => 'array',
        'faq' => 'array',
    ];

    public $timestamps = false;

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function toSitemapTag(): string|array
    {
        return route('subcategory', $this);
    }
}
