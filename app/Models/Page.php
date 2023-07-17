<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public static self $site;

    protected $fillable = [
        'alter',
        'content',
        'seo',
    ];

    protected $casts = [
        'content' => 'array',
        'seo' => 'array',
    ];

    public $timestamps = false;
}
