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

        parent::updated(function (Author $author) {
            foreach ($author->articles as $article) {
                $article->update();
            }
        });
    }
}
