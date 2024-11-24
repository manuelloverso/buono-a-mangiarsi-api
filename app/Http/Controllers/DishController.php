<?php

namespace App\Http\Controllers;

use App\Domain\Aggregates\DishAggregateRoot;
use App\Domain\Repositories\DishRepository;
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
            return response(new DishCollection($dishes));
        } else {
            return response(new ErrorResource(400, 'Something went wrong in fetching dishes'), 400);
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
            return response(new DishResource($aggregate));
        } else {
            return response(new ErrorResource(400, 'Dish storing wasnt successfull'), 400);
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
            return response(new DishResource($dish));
        } else {
            return response(new ErrorResource(400, 'Something went wrong in fetching the dish'), 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDishRequest $request, string $id)
    {
        $params = $request->all();
        $params['id'] = $id;

        $aggregate = new DishAggregateRoot($params);

        $repository = new DishRepository();
        $result = $repository->update($params, $id);

        if ($result['success']) {
            return response(new DishResource($aggregate));
        } else if ($result['status'] == 404) {
            return response(new ErrorResource(404, 'Dish not found'), 404);
        } else {
            return response(new ErrorResource(400, 'Something went wrong in updating the dish'), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //
    }
}
