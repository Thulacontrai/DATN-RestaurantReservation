<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Table extends Model
{
    use SoftDeletes;

    protected $table = 'tables';

    protected $fillable = [
        'area',
        'table_number',
        'table_type',
        'status',
        'parent_id',
    ];

    protected $dates = ['deleted_at'];

    public function parentTable()
    {
        return $this->belongsTo(Table::class, 'parent_id');
    }
}
