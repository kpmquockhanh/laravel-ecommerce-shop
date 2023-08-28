<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($c) {
                return [
                    'id' => $c->id,
                    'slug' => $c->slug,
                    'title' => $c->title,
                    'thumbnail' => $c->thumbnail,
                    'categories' => $c->categories,
                    'price' => $c->price,
                ];
            }),
        ];
//        return parent::toArray($request);
    }
}
