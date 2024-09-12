<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{

    use HasFactory;

    protected $table = 'combos'; 

    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
        'quantity_dishes',
    ];
}
