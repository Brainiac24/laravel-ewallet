<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnsParentIdAndMerchantItemIdToTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->uuid('parent_id')->nullable()->after('id')->default(null);
            $table->uuid('merchant_item_id')->nullable()->after('order_id')->default(null);


            $table->foreign('merchant_item_id')->references('id')->on('merchant_items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            //
        });
    }
}
