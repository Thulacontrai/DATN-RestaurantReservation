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
        'final_amount',
        'coupon_id',
    ];

    
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
}
