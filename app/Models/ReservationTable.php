<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationTable extends Model
{
    protected $table = 'reservation_tables';

    protected $fillable = [
        'reservation_id',
        'status',
        'start_time',
        'end_time',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
