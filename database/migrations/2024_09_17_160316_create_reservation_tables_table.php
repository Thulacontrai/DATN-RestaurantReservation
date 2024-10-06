<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationTablesTable extends Migration
{
    public function up()
    {
        Schema::create('reservation_table', function (Blueprint $table) {
            $table->foreignId('reservation_id')->constrained()->onDelete('cascade');
            $table->foreignId('table_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['available', 'reserved', 'occupied', 'cleaning'])->default('available');
            $table->date('reservation_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->timestamps(); // created_at và updated_at

            // Foreign key
            $table->primary(['reservation_id', 'table_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservation_table');
    }
}

