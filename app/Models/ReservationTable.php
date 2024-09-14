<?php

namespace App\Models;

use App\Traits\TraitCRUD;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ReservationTable extends Model
{
    use HasFactory;

    protected $table = 'reservation_tables';

    protected $fillable = [
        'reservation_id',
        'status',
        'start_time',
        'end_time'
    ];
}
