<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientsTable extends Migration
{
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id(); // bigint, auto-increment
            $table->string('name', 255); // varchar(255), không cho phép NULL
            $table->unsignedBigInteger('supplier_id'); // bigint, không cho phép NULL
            $table->decimal('price', 10, 2); // decimal(10,2), không cho phép NULL
            $table->string('unit', 50); // varchar(50), không cho phép NULL
            $table->unsignedBigInteger('ingredient_type_id'); // bigint, không cho phép NULL
            $table->timestamps(); // created_at và updated_at

            // Khóa ngoại
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreign('ingredient_type_id')->references('id')->on('ingredient_types')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ingredients');
    }
}
