<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationTablesTable extends Migration
{
    public function up()
    {
        Schema::create('reservation_table', function (Blueprint $table) {
            $table->id('table_id'); // bigint, auto-increment
            $table->unsignedBigInteger('reservation_id');
            $table->enum('status', ['available', 'reserved', 'occupied', 'cleaning'])->default('available');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->timestamps(); // created_at và updated_at

            // Foreign key
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservation_table');
    }
}

