<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationTable extends Model
{

    protected $table = 'reservation_table';
    


    public $incrementing = false;
    protected $primaryKey = ['table_id', 'reservation_id'];

    protected $fillable = [
        'reservation_id',
        'status',
        'table_id',
        'start_time',
        'end_time',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
    public function tables()
    {
        return $this->belongsToMany(Table::class, 'reservation_table')
            ->withPivot('start_date', 'start_time', 'end_time', 'status');
    }
}
