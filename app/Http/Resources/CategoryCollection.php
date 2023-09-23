<?php

namespace App\Http\Resources;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $ids = $this->collection->pluck('id');
        $count = ProductCategory::query()
            ->groupBy('category_id')
            ->selectRaw('category_id, COUNT(*) as count')
            ->whereIn('category_id', $ids->toArray())->get();
        $mapCount = [];
        foreach ($count as $c) {
            $mapCount["category-$c->category_id"] = $c->count;
        }
        return [
            'data' => $this->collection->map(function ($c) {
                return [
                    'id' => $c->id,
                    'name' => $c->name,
                    'code' => $c->code,
                ];
            }),
            'count'=> $mapCount,
        ];
    }
}
