<?php

namespace App\Domain\Repositories;

use App\Domain\Aggregates\DishAggregateRoot;
use App\Models\Dish;
use Exception;

class DishRepository
{
    public function getAll(array $filters)
    {
        try {
            $dishes = Dish::all();
            return $dishes;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getDetail(string $id)
    {
        //
    }

    public function store($params, $aggregate): bool
    {
        try {
            $dish = Dish::create($params);
            $aggregate->id = $dish->id;
        } catch (Exception $e) {
            $aggregate->id = null;
            return false;
        }
        return true;
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
