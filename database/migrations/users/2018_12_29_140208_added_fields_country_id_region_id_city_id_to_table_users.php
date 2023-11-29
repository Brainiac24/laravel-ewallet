<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddedFieldsCountryIdRegionIdCityIdToTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->uuid('country_id')->nullable();
            $table->uuid('country_born_id')->nullable();
            $table->uuid('region_id')->nullable();
            $table->uuid('area_id')->nullable();
            $table->uuid('city_id')->nullable();
            $table->uuid('document_type_id')->nullable();
            $table->string('code_map')->nullable()->unique();

            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('country_born_id')->references('id')->on('countries');
            $table->foreign('region_id')->references('id')->on('regions');
            $table->foreign('city_id')->references('id')->on('city');
            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('document_type_id')->references('id')->on('document_types');
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
