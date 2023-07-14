<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Article extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'read_time',
        'tags',
        'author',
        'content',
        'seo',
    ];

    protected $casts = [
        'tags' => 'array',
        'author' => 'array',
        'content' => 'array',
        'seo' => 'array',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function view(): MorphOne
    {
        return $this->morphOne(View::class, 'viewable');
    }
}
