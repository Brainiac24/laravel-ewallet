<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddedFieldsCashbackDatesToMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchants', function (Blueprint $table) {
            $table->datetime('bank_cashback_end_date')->nullable()->after("bank_cashback_id");
            $table->datetime('bank_cashback_start_date')->nullable()->after("bank_cashback_id");
            $table->datetime('merchant_cashback_end_date')->nullable()->after("merchant_cashback_id");
            $table->datetime('merchant_cashback_start_date')->nullable()->after("merchant_cashback_id");
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
