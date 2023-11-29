<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddedColumnsForCurrencyExchangeToTableTransactionHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_histories', function (Blueprint $table) {
            $table->string('from_currency_iso_name')->nullable()->after('amount')->default(null);
            DB::statement("ALTER TABLE `transaction_histories` CHANGE `currency_rate_value` `currency_rate_value` decimal(11,4) DEFAULT 0.0000  NULL  AFTER `commission`");
            $table->string('to_currency_iso_name')->nullable()->after('commission')->default(null);
            $table->decimal('converted_amount', 11, 4)->after('commission')->default(0);
            $table->string('currency_iso_name', 50)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_histories', function (Blueprint $table) {
            //
        });
    }
}
