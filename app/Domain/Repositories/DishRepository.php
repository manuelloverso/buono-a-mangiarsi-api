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

    public function getDetail(int $id)
    {
        try {
            $dish = Dish::find($id);
            return $dish;
        } catch (Exception $e) {
            return false;
        }
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

    public function update(array $params, int $id)
    {
        try {
            $dish = Dish::find($id);
            if ($dish) {
                $dish->update($params);
            } else {
                return ['success' => false, 'status' => 404];
            }
        } catch (Exception $e) {
            return ['success' => false, 'status' => 400];
        }
        return ['success' => true, 'status' => 200];
    }

    public function delete(string $id): bool
    {
        return false;
    }
}
