<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderAccountTypeItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_account_type_items', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('code', 150)->nullable();
            $table->string('code_map', 150)->unique()->nullable();
            $table->string('name', 255)->nullable();
            $table->uuid('currency_id');
            $table->uuid('order_account_type_id');
            $table->double('position')->default(0);
            $table->boolean('is_active')->nullable()->default(1);
            $table->timestamps();

            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->foreign('order_account_type_id')->references('id')->on('order_account_types');

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
        Schema::dropIfExists('order_account_type_items');
    }
}
