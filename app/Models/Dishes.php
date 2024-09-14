<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dishes extends Model
{
    use HasFactory;

    protected $table = 'dishes';


    protected $fillable = ['name', 'category_id', 'price', 'quantity', 'status', 'image'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
