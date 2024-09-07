<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'staff_id',
        'table_id',
        'customer_id',
        'total_amount',
        'order_type',
        'status',
        'discount_amount',
        'final_amount'
    ];
}
