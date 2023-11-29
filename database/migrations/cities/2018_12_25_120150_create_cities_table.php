<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('code',150)->nullable()->unique();
            $table->string('code_map',150)->unique();
            $table->string('name',255);
            $table->text('desc')->nullable();
            $table->boolean('is_active')->nullable()->default(1);
            $table->uuid('area_id');
            $table->timestamps();

            $table->foreign('area_id')->references('id')->on('areas');

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
        Schema::dropIfExists('city');
    }
}
