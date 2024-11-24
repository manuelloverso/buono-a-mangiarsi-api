<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DishCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'success' => true,
            'status' => 200,
            'data' => $this->collection->map(function ($dish) {
                // Extract only the 'data' part of each DishResource
                return (new DishResource($dish))->resolve()['data'];
            }),
        ];
        // return parent::toArray($request);
    }
}
