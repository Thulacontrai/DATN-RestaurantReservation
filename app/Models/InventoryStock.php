<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryStock extends Model
{
    use HasFactory;
    protected $fillable = ['ingredient_id', 'quantity_stock', 'last_update'];
    public $timestamps = false;
    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}
