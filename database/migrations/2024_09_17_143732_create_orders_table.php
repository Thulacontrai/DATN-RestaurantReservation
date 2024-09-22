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
        if (!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reservation_id');
            $table->unsignedBigInteger('staff_id');
            $table->unsignedBigInteger('table_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->enum('order_type', ['dine_in', 'take_away', 'delivery']);
            $table->enum('status', ['pending', 'completed', 'cancelled']);
            $table->decimal('discount_amount', 10, 2)->nullable();
            $table->decimal('final_amount', 10, 2)->nullable();
            $table->softDeletes();
            $table->timestamps();

            // Khóa ngoại
            // $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
            // $table->foreign('staff_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('table_id')->references('id')->on('tables')->onDelete('set null');
            // $table->foreign('customer_id')->references('id')->on('users')->onDelete('set null');
        });
    }
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

