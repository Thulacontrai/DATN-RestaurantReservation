<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('order_tables', function (Blueprint $table) {
            $table->id();
            // Đổi kiểu dữ liệu thành unsignedBigInteger và bỏ unique
            $table->unsignedBigInteger('order_id'); 
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            
            $table->unsignedBigInteger('table_id'); // Nếu `table_id` cũng tham chiếu đến bảng khác, cần đảm bảo kiểu dữ liệu tương thích
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->enum('status', ['trống', 'Đặt trước', 'Đang sử dụng', 'Đang chờ khách']);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_tables');
    }
};
