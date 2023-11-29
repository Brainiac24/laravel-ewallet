<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCoordinatePointTypeService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coordinate_point_type_services', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('coordinate_point_type_id');
            $table->uuid('coordinate_point_service_id');
            $table->boolean('is_active')->nullable()->default(1);
            $table->timestamps();
            $table->foreign('coordinate_point_type_id', 'coor_point_type_coor_point_service')->references('id')->on('coordinate_point_types');
            $table->foreign('coordinate_point_service_id','coor_point_service_coor_point_service')->references('id')->on('coordinate_point_services');

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
        Schema::dropIfExists('coordinate_point_type_service');
    }
}
