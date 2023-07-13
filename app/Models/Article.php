<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'read_time',
        'views',
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
}
