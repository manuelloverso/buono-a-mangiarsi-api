<?php

namespace App\Http\Controllers;

use App\Domain\Aggregates\DishAggregateRoot;
use App\Domain\Repositories\DishRepository;
use App\Models\Dish;
use App\Http\Requests\StoreDishRequest;
use App\Http\Requests\UpdateDishRequest;
use App\Http\Resources\DishCollection;
use App\Http\Resources\DishResource;
use App\Http\Resources\ErrorResource;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $repository = new DishRepository();
        $dishes =  $repository->getAll([]);
        if ($dishes) {
            return new DishCollection($dishes);
        } else {
            return new ErrorResource(400, 'Something went wrong in fetching dishes');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDishRequest $request)
    {
        //im using the aggregate only here even tho i wouldnt need it
        $params = $request->all();

        //create aggregate
        $aggregate = new DishAggregateRoot();
        $aggregate->create($params);

        //store the record
        $repository = new DishRepository();
        $result = $repository->store($params, $aggregate);

        //handle response
        if ($result) {
            return new DishResource($aggregate);
        } else {
            return new ErrorResource(400, 'Dish storing wasnt successfull');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $repository = new DishRepository();
        $dish = $repository->getDetail($id);

        if ($dish) {
            return new DishResource($dish);
        } else {
            return new ErrorResource(400, 'Something went wrong in fetching the dish');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDishRequest $request, Dish $dish)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish)
    {
        //
    }
}
