<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationHistoryTable extends Migration
{
    public function up()
    {
        Schema::create('reservation_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reservation_id');
            $table->timestamp('change_time');
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed']);
            $table->text('note')->nullable();
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservation_history');
    }
}
