<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_users', function (Blueprint $table) 
        {
            $table->uuid('id');
            $table->string('code_map', 150)->unique();
            $table->string('first_name', 150)->nullable();
            $table->string('last_name', 150)->nullable();
            $table->string('middle_name', 150)->nullable();
            $table->bigInteger('msisdn')->unique();
            $table->text('contacts_json')->nullable();
            $table->uuid('country_id')->nullable();
            $table->uuid('country_born_id')->nullable();
            $table->uuid('region_id')->nullable();
            $table->uuid('area_id')->nullable();
            $table->uuid('city_id')->nullable();
            $table->uuid('document_type_id')->nullable();

            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('country_born_id')->references('id')->on('countries');
            $table->foreign('region_id')->references('id')->on('regions');
            $table->foreign('city_id')->references('id')->on('city');
            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('document_type_id')->references('id')->on('document_types');
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
        Schema::dropIfExists('temp_users');
    }
}
