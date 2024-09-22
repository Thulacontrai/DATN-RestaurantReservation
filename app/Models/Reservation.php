<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use SoftDeletes;

    protected $table = 'reservations';

    protected $fillable = [
        'customer_id',
        'user_name',
        'user_phone',
        'coupon_id',
        'reservation_time',
        'reservation_date',
        'guest_count',
        'deposit_amount',
        'status',
        'cancelled_reason',
        'note',
    ];

    protected $dates = ['deleted_at'];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }
}
