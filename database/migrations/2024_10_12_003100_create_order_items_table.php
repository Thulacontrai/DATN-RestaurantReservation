<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id(); // Tạo trường khóa chính, tự động tăng
            $table->unsignedBigInteger('order_id'); // Khóa ngoại đến bảng orders
            $table->integer('item_id'); // ID của sản phẩm hoặc dịch vụ
            $table->string('item_type', 10); // Loại item (ví dụ: sản phẩm, dịch vụ)
            $table->integer('quantity'); // Số lượng
            $table->decimal('price', 10, 2); // Đơn giá của từng item
            $table->decimal('total_price', 10, 2); // Tổng giá cho từng item (quantity * price)
            $table->string('status', 50)->nullable(); // Trạng thái đơn hàng (nullable)
            $table->timestamps(); // created_at và updated_at tự động

            // Thiết lập khóa ngoại cho order_id
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
