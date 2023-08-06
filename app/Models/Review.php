<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'name',
        'content',
        'rating',
        'url',
    ];

    protected $casts = [
        'updated_at' => 'date:d.m.Y'
    ];
}
