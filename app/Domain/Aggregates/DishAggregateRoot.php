<?php

namespace App\Domain\Aggregates;

class DishAggregateRoot
{
    public string $id;
    public string $name;
    public string $description;
    public string $price;
    public string $image;
    public bool $is_available;

    public function create($params): void
    {
        //
    }
}
