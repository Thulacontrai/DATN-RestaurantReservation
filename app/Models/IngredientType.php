<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IngredientType extends Model
{
    protected $table = 'ingredient_types';

    protected $fillable = [
        'name',
    ];
}
