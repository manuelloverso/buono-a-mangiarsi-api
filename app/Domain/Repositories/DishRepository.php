<?php

namespace App\Domain\Repositories;

use App\Domain\Aggregates\DishAggregateRoot;

class DishRepository
{
    public function getAll(array $filters)
    {
        //
    }

    public function getDetail(string $id)
    {
        //
    }

    public function store(DishAggregateRoot $aggregate): bool
    {
        return false;
    }

    public function update(DishAggregateRoot $aggregate): bool
    {
        return false;
    }

    public function delete(string $id): bool
    {
        return false;
    }
}
