<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCoordinatePointCities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coordinate_point_cities', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('city_id');
            $table->integer('version');
            $table->boolean('is_active')->nullable()->default(1);
            $table->timestamps();

            $table->primary('id');
            $table->foreign('city_id', 'coordinate_point_city_city')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coordinate_point_cities');
    }
}
