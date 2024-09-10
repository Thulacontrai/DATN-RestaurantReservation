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
        Schema::create('reservation_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained('reservations');
            $table->foreignId('user_id')->constrained('users');
            $table->datetime('status_change_time');
            $table->enum('previous_status', ['Confirmed', 'Pending', 'Cancelled']);
            $table->enum('new_status', ['Confirmed', 'Pending', 'Cancelled']);
            $table->text('note')->nullable();
            $table->timestamps(); 
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_history');
    }
};
