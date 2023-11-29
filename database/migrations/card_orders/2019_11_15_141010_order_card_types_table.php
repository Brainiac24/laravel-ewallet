<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrderCardTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_card_types', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('code', 150)->nullable();
            $table->string('code_map', 150)->unique()->nullable();
            $table->string('name', 255)->nullable();
            $table->float('price');
            $table->float('insurance_price');
            $table->integer('code_ibank');
            $table->uuid('currency_id');
            $table->uuid('order_card_contract_type_id');
            $table->boolean('is_active')->nullable()->default(1);
            $table->timestamps();

            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->foreign('order_card_contract_type_id')->references('id')->on('order_card_contract_types');

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
        Schema::dropIfExists('order_card_types');
    }
}
