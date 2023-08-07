<?php

namespace App\Http\Resources;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleShowResource extends JsonResource
{
    /**
     * @var Article
     */
    public $resource;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'description' => $this->resource->description,
            'image' => asset('storage/' . $this->resource->image),
            'date' => $this->resource->updated_at->format('d.m.Y'),
            'faq' => $this->resource->faq,
            'author' => [
                'name' => $this->resource->author->name,
                'post' => $this->resource->author->post,
                'image' => asset('storage/' . $this->resource->author->image),
            ],
            'read_time' => $this->resource->read_time,
            'content' => $this->resource->content,
            'rating' => $this->resource->rating->id,
            'views' => $this->resource->rating->views,
            'likes' => $this->resource->rating->likes,
            'dislikes' => $this->resource->rating->dislikes,
        ];
    }
}
