<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{

    use HasFactory;

    protected $fillable = [
        'code',
        'description',
        'max_uses',
        'start_time',
        'end_time',
        'discount_type',
        'discount_amount',
        'status',
    ];
}
