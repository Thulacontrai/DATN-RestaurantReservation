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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->nullable()->constrained('reservations')->onDelete('set null');
            $table->foreignId('bill_id')->nullable();
            $table->foreignId('transaction_id')->nullable();
            $table->decimal('refund_amount', 10, 2)->nullable();
            $table->decimal('amount', 10, 2);
            $table->enum('transaction_status', ['pending', 'completed', 'failed']);
            $table->enum('payment_method', ['cash', 'credit_card', 'online']);
            $table->enum('status', ['Completed', 'Pending', 'Failed']);
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
