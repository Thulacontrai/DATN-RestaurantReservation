<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'supplier_id', 'price', 'unit', 'ingredient_type_id'];

    // Relationships
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function ingredientType()
    {
        return $this->belongsTo(IngredientType::class);
    }
}
