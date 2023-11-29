<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddedFieldToCoordinatePoints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coordinate_points', function (Blueprint $table) {
            $table->uuid('merchant_id')->after('object_type')->nullable();
            $table->uuid('coordinate_point_type_id')->after('object_type')->nullable();
            $table->uuid('coordinate_point_workday_id')->after('object_type')->nullable();

            $table->foreign('merchant_id')->references('id')->on('merchants');
            $table->foreign('coordinate_point_type_id')->references('id')->on('coordinate_point_types');
            $table->foreign('coordinate_point_workday_id')->references('id')->on('coordinate_point_workdays');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
