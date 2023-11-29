<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCoordinatePointTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coordinate_point_types', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name',255);
            $table->string('code',50);
            $table->integer('position');
            $table->uuid('coordinate_point_workday_id');
            $table->boolean('is_active')->nullable()->default(1);
            $table->boolean('is_show_for_filter')->default(0);
            $table->timestamps();

            $table->foreign('coordinate_point_workday_id')->references('id')->on('coordinate_point_workdays');
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coordinate_point_types');

    }
}
