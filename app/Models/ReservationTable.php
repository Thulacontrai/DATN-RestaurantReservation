<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationTable extends Model
{
    // Correct table name
    protected $table = 'reservation_tables';

    // Define fillable fields
    protected $fillable = [
        'reservation_id',
        'table_id',
        'status',
        'start_time',
        'end_time',
    ];

    // Relationship with the Table model
    public function table()
    {
        return $this->belongsTo(Table::class, 'table_id');
    }

    // Relationship with the Reservation model
    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_id');
    }
}
