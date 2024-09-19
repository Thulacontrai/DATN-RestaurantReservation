<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationDishesTable extends Migration
{
    public function up()
    {
        Schema::create('reservation_dishes', function (Blueprint $table) {
            $table->id(); // bigint, auto-increment
            $table->unsignedBigInteger('reservation_id'); // bigint, không cho phép NULL
            $table->unsignedBigInteger('dish_id'); // bigint, không cho phép NULL
            $table->integer('quantity'); // int, không cho phép NULL
            $table->decimal('price', 10, 2); // decimal(10,2), không cho phép NULL
            $table->timestamps(); // created_at và updated_at

            // Khóa ngoại
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
            $table->foreign('dish_id')->references('id')->on('dishes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservation_dishes');
    }
}
