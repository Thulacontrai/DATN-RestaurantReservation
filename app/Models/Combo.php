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
<<<<<<< HEAD

    public function dishes()
    {
        return $this->belongsToMany(Dishes::class, 'combo_dish', 'combo_id', 'dish_id')->withPivot('quantity')->withTimestamps();
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'item_id');
    }
=======
>>>>>>> 5cc51a89bb95b5109df530d2307b9d681decb08e
}

