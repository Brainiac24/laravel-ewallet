<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('code',150)->unique();
            $table->string('name',255);
            $table->string('short_name',50)->unique();
            $table->string('iso_name')->unique();
            $table->string('symbol_left')->nullable();
            $table->string('symbol_right')->nullable();
            $table->boolean('is_primary')->default(0);
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
        Schema::dropIfExists('currencies');
    }
}
