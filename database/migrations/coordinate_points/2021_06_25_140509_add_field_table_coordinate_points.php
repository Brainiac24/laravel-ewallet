<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldTableCoordinatePoints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coordinate_points', function (Blueprint $table){
            $table->uuid('coordinate_point_city_id')->nullable();
            $table->foreign('coordinate_point_city_id')->references('id')->on('coordinate_point_cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coordinate_points', function (Blueprint $table){
            $table->dropColumn('coordinate_point_city_id');
        });
    }
}
