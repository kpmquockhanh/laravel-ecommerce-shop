<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $images = $this->images->map(function ($image) {
            return [
                'src' => $image->href,
                'is_thumbnail' => $image->is_thumbnail,
            ];
        });
        if (!$images->count()) {
            $images = collect([
                [
                    'src' => asset('backend/img/placeholder.jpg'),
                    'is_thumbnail' => false
                ]
            ]);
        }
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'thumbnail' => $this->thumbnail,
            'categories' => $this->categories,
            'price' => $this->price,
            'compare_price' => $this->compare_price ?? 0,
            'description' => $this->description,
            'images' => $images,
            'variants' => $this->variants,
        ];
    }
}
