<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Str;
use Spatie\Sitemap\Contracts\Sitemapable;

class Article extends Model implements Sitemapable
{
    protected $fillable = [
        'name',
        'slug',
        'read_time',
        'tags',
        'image',
        'author_id',
        'content',
        'description',
        'faq',
    ];

    protected $casts = [
        'tags' => 'array',
        'content' => 'array',
        'faq' => 'array',
        'updated_at' => 'date:d.m.y',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function rating(): MorphOne
    {
        return $this->morphOne(Rating::class, 'rateable');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function toSitemapTag(): string|array
    {
        return route('article', $this);
    }

    public static function boot(): void
    {
        parent::boot();

        self::created(function (Article $article) {
            $article->rating()->save(new Rating);
        });

        self::saving(function (Article $article) {
            $authors = [];
            $content = [];

            foreach ($article->content as $value) {
                if ($value['type'] == 'quote') {
                    if (isset($authors[$value['data']['author_id']])) {
                        $author = $authors[$value['data']['author_id']];
                    } else {
                        $author = Author::whereId($value['data']['author_id'])->first();
                        $authors[$value['data']['author_id']] = $author;
                    }

                    if ($author) {
                        $value['data']['author'] = [
                            'name' => $author->name,
                            'post' => $author->post,
                            'image' => $author->image,
                        ];
                    } else {
                        unset($value);
                    }
                }

                if (isset($value)) {
                    $content[] = $value;
                }
            }

            $article->content = $content;
        });
    }

    public static function format(Collection $articles): Collection
    {
        return $articles->map(function (self $article) {
            $article->image = asset('storage/' . $article->image);
            $article->name = Str::words($article->description, 5);
            $article->description = Str::words($article->description, 25);

            return $article;
        });
    }
}
