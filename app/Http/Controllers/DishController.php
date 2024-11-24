<?php

namespace App\Http\Controllers;

use App\Domain\Aggregates\DishAggregateRoot;
use App\Domain\Repositories\DishRepository;
use App\Models\Dish;
use App\Http\Requests\StoreDishRequest;
use App\Http\Requests\UpdateDishRequest;
use App\Http\Resources\DishResource;
use App\Http\Resources\ErrorResource;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDishRequest $request)
    {
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
    public function show(Dish $dish)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dish $dish)
    {
        //
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
