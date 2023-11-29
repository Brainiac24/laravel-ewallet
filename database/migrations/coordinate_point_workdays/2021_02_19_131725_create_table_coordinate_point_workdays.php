<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCoordinatePointWorkdays extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coordinate_point_workdays', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name',255)->nullable();
            $table->string('monday',255)->nullable();
            $table->string('tuesday',255)->nullable();
            $table->string('wednesday',255)->nullable();
            $table->string('thursday',255)->nullable();
            $table->string('friday',255)->nullable();
            $table->string('saturday',255)->nullable();
            $table->string('sunday',255)->nullable();
            $table->boolean('is_active')->default(1);
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
        Schema::dropIfExists('coordinate_point_workdays');
    }
}
