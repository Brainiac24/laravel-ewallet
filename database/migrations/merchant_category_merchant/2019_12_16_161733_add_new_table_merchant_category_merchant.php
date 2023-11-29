<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewTableMerchantCategoryMerchant extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_category_merchant', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('merchant_category_id');
            $table->uuid('merchant_id');

            $table->foreign('merchant_category_id')->references('id')->on('merchant_categories');
            $table->foreign('merchant_id')->references('id')->on('merchants');
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
        Schema::dropIfExists('merchant_category_merchant');
    }
}
