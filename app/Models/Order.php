<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table = 'orders';

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

