<?php

namespace App\Domain\Aggregates;

class DishAggregateRoot
{
    public ?int $id;
    public string $name;
    public ?string $description;
    public string $price;
    public ?string $image;
    public bool $is_available;

    public function create($params): void
    {
        $this->id = $params['id'] ?? null; //it's AI
        $this->name = $params['name'];
        $this->description = $params['description'] ?? null;
        $this->price = $params['price'];
        $this->image = $params['image'] ?? null;
        $this->is_available = $params['is_available'];
    }
}
