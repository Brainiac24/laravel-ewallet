<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewTableMerchantItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_items', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name',255);
            $table->string('phone',50)->nullable();
            $table->string('address',255)->nullable();
            $table->bigInteger('account_number')->nullable();
            $table->uuid('merchant_id');
            $table->uuid('account_id');
            $table->boolean('is_active')->default(1);
            $table->timestamps();

            $table->foreign('merchant_id')->references('id')->on('merchants');
            $table->foreign('account_id')->references('id')->on('accounts');
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
        Schema::dropIfExists('merchant_items');
    }
}
