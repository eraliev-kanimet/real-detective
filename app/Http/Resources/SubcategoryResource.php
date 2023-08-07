<?php

namespace App\Http\Resources;

use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubcategoryResource extends JsonResource
{
    /**
     * @var Subcategory
     */
    public $resource;

    public function toArray(Request $request): array
    {
        $rating = [];

        for ($i = 0; $i < ceil($this->resource->basic['rating']); $i++) {
            $rating[] = $this->resource->basic['rating'];
        }

        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'slug' => $this->resource->slug,
            'contract_type' => $this->resource->contract_type,
            'average_receipt' => $this->resource->average_receipt,
            'minimum_advance_amount' => $this->resource->minimum_advance_amount,
            'video' => [
                'url' => $this->resource->basic['video']['url'],
                'image' => asset('storage/' . $this->resource->basic['video']['image']),
            ],
            'basic' => $this->resource->basic,
            'description' => $this->resource->basic['description'],
            'rating' => $this->resource->basic['rating'],
            'rating_array' => $rating,
            'content' => $this->resource->content,
            'faq' => $this->resource->faq,
            'related' => Subcategory::whereIn('id', $this->resource->basic['related'])
                ->get(['id', 'slug', 'name', 'minimum_advance_amount'])
        ];
    }
}
