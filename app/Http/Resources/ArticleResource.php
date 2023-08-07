<?php

namespace App\Http\Resources;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class ArticleResource extends JsonResource
{
    /**
     * @var Article
     */
    public $resource;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'slug' => $this->resource->slug,
            'name' => Str::words($this->resource->name, 5),
            'description' => Str::words($this->resource->description, 25),
            'image' => asset('storage/' . $this->resource->image),
            'date' => $this->resource->updated_at->format('d.m.y'),
            'tags' => $this->resource->tags
        ];
    }
}
