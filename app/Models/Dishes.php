<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dishes extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'dishes';


    protected $fillable = [
        'name',
        'category_id',
        'price',
        'quantity',
        'description',
        'status',
        'image',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
