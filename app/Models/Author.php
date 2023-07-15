<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Author extends Model
{
    protected $fillable = [
        'name',
        'image',
        'post',
        'about',
    ];

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public $timestamps = false;

    public static function boot(): void
    {
        parent::boot();

        self::updated(function () {
            foreach (Article::all() as $article) {
                $article->update();
            }
        });

        self::deleted(function () {
            foreach (Article::all() as $article) {
                $article->update();
            }
        });
    }
}
