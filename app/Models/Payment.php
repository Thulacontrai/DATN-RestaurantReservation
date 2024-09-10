<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'bill_id',
        'transaction_id',
        'refund_amount',
        'amount',
        'transaction_status',
        'payment_method',
        'status',
    ];
}
