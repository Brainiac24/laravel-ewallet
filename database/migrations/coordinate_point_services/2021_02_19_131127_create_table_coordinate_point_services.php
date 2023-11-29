<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCoordinatePointServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coordinate_point_services', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name',255);
            $table->integer('position');
            $table->boolean('is_show_for_filter')->nullable()->default(0);
            $table->boolean('is_active')->nullable()->default(1);
            $table->timestamps();

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
        Schema::dropIfExists('coordinate_point_services');
    }
}
