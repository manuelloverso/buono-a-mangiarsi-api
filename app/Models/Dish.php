<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{

    protected $table = 'dishes';
    protected $fillable = ['name', 'description', 'image', 'price', 'is_available'];
}
