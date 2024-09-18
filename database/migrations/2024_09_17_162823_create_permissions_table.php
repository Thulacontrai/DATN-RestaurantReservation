<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id(); // bigint, auto-increment
            $table->string('permission_name', 255); // varchar(255), không cho phép NULL
            $table->text('description')->nullable(); // text, cho phép NULL
            $table->timestamps(); // created_at và updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
