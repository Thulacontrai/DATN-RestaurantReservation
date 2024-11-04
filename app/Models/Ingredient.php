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

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    public function inventoryStock()
    {
        return $this->hasOne(InventoryStock::class);
    }

    public function inventoryItems()
    {
        return $this->hasMany(InventoryItem::class);
    }
}
