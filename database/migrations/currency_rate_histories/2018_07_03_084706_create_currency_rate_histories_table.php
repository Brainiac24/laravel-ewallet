<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrencyRateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency_rate_histories', function (Blueprint $table) {
            $table->uuid('id');
            $table->decimal('value_buy',11,4)->default(0);
            $table->decimal('value_sell',11,4)->default(0);
            $table->uuid('currency_id');
            $table->timestamps();
            
            $table->foreign('currency_id')->references('id')->on('currencies');

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
        Schema::dropIfExists('currency_rate_histories');
    }
}
