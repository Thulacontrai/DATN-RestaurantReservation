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
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'orders_tables')
            ->withPivot('start_time', 'end_time', 'status');
    }



<<<<<<< HEAD
    //Giải thích:
    // Carbon: Sử dụng thư viện Carbon để tính thời gian khách đã ngồi tại bàn.
    // Tính toán phần trăm chiếm dụng: Hàm getOccupancyPercentage() sẽ trả về giá trị phần trăm
    // dựa trên thời gian khách đã ngồi, với mức tối đa là 120 phút.

    public function getOccupancyPercentage()
    {
        $maxTime = 120; // Giả định thời gian tối đa một bàn có thể chiếm dụng là 120 phút
        $timeSpent = Carbon::now()->diffInMinutes($this->occupied_since);

        return min(100, ($timeSpent / $maxTime) * 100); // Tính toán phần trăm chiếm dụng
    }

    //occupied_since: Thoi gian hien tai---- xem thử nhé nhóm trưởng có cần cho vào dtb ko ??????????
=======
>>>>>>> 5cc51a89bb95b5109df530d2307b9d681decb08e
}
