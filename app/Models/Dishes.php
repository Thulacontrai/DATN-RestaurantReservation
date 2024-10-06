<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dishes extends Model
{
    use HasFactory, SoftDeletes; // Kết hợp HasFactory và SoftDeletes

    protected $dates = ['deleted_at']; // Khai báo cột deleted_at

    protected $table = 'dishes'; // Tên bảng trong cơ sở dữ liệu

    protected $fillable = [
        'name',
        'category_id',
        'price',
        'quantity',
        'description',
        'status',
        'image',
    ];

    // Quan hệ với bảng Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id'); // Một món ăn thuộc về một loại
    }

    // Quan hệ với bảng OrderItem
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class); // Một món ăn có thể thuộc về nhiều đơn hàng
    }

    /**
     * Kiểm tra xem món ăn còn hàng hay không.
     *
     * @return bool
     */
    public function isAvailable()
    {
        return $this->quantity > 0; // Trả về true nếu còn hàng
    }

    /**
     * Cập nhật số lượng món ăn sau khi bán.
     *
     * @param int $quantity
     * @return void
     */
    public function updateQuantity(int $quantity)
    {
        if ($this->quantity >= $quantity) {
            $this->quantity -= $quantity; // Giảm số lượng
            $this->save(); // Lưu thay đổi
        } else {
            throw new \Exception('Không đủ số lượng món ăn.'); // Thông báo nếu không đủ số lượng
        }
    }
}
