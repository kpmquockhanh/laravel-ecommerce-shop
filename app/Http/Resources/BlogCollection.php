<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BlogCollection extends ResourceCollection
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
                    'title' => $c->title,
                    'created_at' => $c->created_at->diffForHumans(),
                    'updated_at' => $c->updated_at->diffForHumans(),
                ];
            }),
        ];
    }
}
