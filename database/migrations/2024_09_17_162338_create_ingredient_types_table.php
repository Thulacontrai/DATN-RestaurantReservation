<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientTypesTable extends Migration
{
    public function up()
    {
        Schema::create('ingredient_types', function (Blueprint $table) {
            $table->id(); // bigint, auto-increment
            $table->string('name', 255); // varchar(255), không cho phép NULL
            $table->timestamps(); // created_at và updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('ingredient_types');
    }
}
