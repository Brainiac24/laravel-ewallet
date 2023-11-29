<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddedFieldCurrencyRateCategoryIdToServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->uuid('currency_rate_category_id')->after('currency_id')->default('ee740875-e0e3-4233-9ef2-5536b5759969');

            $table->foreign('currency_rate_category_id')->references('id')->on('currency_rate_categories');
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
