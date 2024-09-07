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
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->enum('area', ['Tầng 1', 'Tầng 2', 'Tầng 3']);
            $table->integer('table_number')->unsigned();
            $table->enum('table_type', ['VIP', 'Thường']);
            $table->enum('status', ['Có sẵn', 'Đang sử dụng', 'Có trước']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
