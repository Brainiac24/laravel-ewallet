<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('code',150)->nullable()->unique();
            $table->string('code_map',150)->unique();
            $table->string('name',255);
            $table->string('iso_2',2)->nullable();
            $table->string('iso_3',3)->nullable();
            $table->text('desc')->nullable();
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
        Schema::dropIfExists('countries');
    }
}
