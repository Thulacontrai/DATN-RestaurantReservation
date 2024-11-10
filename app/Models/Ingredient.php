<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $table = 'ingredients';

    protected $fillable = [
        'name',
        'supplier_id',
        'price',
        'unit',
        'ingredient_type_id',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function ingredientType()
    {
        return $this->belongsTo(IngredientType::class);
    }
}
