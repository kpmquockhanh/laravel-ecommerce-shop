<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SettingsResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($c) {
                return [
                    'id' => $c->id,
                    'key' => $c->key,
                    'value' => $c->value,
                    'image' => $c->images->map(function ($i) {
                        return [
                            'id' => $i->id,
                            'url' => $i->href,
                        ];
                    })->get(0),
                ];
            }),
        ];
    }
}
