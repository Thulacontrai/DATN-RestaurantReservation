<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationHistory extends Model
{
    protected $table = 'reservation_history';

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
   
}
