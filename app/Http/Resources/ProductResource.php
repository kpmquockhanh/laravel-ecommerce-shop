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
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'thumbnail' => $this->thumbnail,
            'categories' => $this->categories,
            'price' => $this->price,
            'description' => $this->description,
            'images' => $this->images->map(function ($image) {
                return [
//                    'id' => $image->id,
                    'src' => $image->src ? env('AWS_URL').$image->src : asset('backend/img/placeholder.jpg'),
                    'is_thumbnail' => $image->is_thumbnail,
                ];
            }),
        ];
    }
}
