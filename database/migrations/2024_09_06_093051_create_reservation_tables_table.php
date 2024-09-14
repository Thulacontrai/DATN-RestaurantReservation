<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationTablesTable extends Migration
{
    public function up()
    {
        Schema::create('reservation_tables', function (Blueprint $table) {
            $table->id('table_id'); // primary key
            $table->integer('reservation_id')->unsigned();
            $table->enum('status', ['available', 'reserved', 'occupied', 'cleaning'])->default('available');
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();

            // Add foreign key reference for reservation_id if it references another table
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservation_tables');
    }
}
