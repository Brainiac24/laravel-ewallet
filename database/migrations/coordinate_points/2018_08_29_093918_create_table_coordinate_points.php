<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCoordinatePoints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coordinate_points', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name',500);
            $table->string('latitude',30);
            $table->string('longitude',30);
            $table->string('address',1500);
            $table->integer('object_type');
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coordinate_points');
    }
}
