<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationTable extends Model
{
    protected $table = 'reservations_table';

    protected $primaryKey = 'table_id';

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

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('table_id', $value)->first();
    }
}
