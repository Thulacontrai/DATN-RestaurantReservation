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

        Schema::create('inventory_transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('transaction_type', ["nhập"]); // Kiểu dữ liệu cho transaction_type
            $table->decimal('total_amount', 10, 2); // Thêm số chữ số cho decimal
            $table->text('description');
            $table->unsignedBigInteger('supplier_id'); // Thay đổi thành unsignedBigInteger
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->unsignedBigInteger('staff_id'); // Thay đổi thành unsignedBigInteger
            $table->timestamp('created_at')->useCurrent(); // Sử dụng thời gian hiện tại
            $table->enum('status', ["chờ xử lý","hoàn thành","Hủy"]); // Kiểu dữ liệu cho status
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_transactions');
    }
};
