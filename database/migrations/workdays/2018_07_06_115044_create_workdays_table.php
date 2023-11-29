<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkdaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workdays', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name',255)->nullable();
            $table->string('monday',255)->nullable();
            $table->string('tuesday',255)->nullable();
            $table->string('wednesday',255)->nullable();
            $table->string('thursday',255)->nullable();
            $table->string('friday',255)->nullable();
            $table->string('saturday',255)->nullable();
            $table->string('sunday',255)->nullable();
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
        Schema::dropIfExists('workdays');
    }
}
