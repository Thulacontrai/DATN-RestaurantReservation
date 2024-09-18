<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Combo extends Model
{
    use SoftDeletes;

    protected $table = 'combos';

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'quantity_dishes',
    ];

    protected $dates = ['deleted_at'];
}

