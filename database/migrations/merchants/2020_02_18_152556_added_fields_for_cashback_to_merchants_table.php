<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddedFieldsForCashbackToMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchants', function (Blueprint $table) {
            //
            $table->uuid('transit_account_id')->nullable()->after('account_number');
            $table->uuid('account_id')->nullable()->after('transit_account_id');
            $table->string('inn',30)->after('account_id');
            $table->text('img_logo')->nullable()->after('inn');
            $table->text('img_ad')->nullable()->after('img_logo');
            $table->text('desc')->nullable()->after('img_ad');
            $table->dropColumn('correspondent_account');
            $table->dropColumn('bic');
            $table->uuid('bank_cashback_id')->nullable()->after('cashback_id');
            $table->uuid('bank_id')->nullable()->after('bank_cashback_id');
            $table->uuid('merchant_commission_id')->nullable()->after('bank_id');
            $table->renameColumn('cashback_id','merchant_cashback_id');

            $table->foreign('transit_account_id')->references('id')->on('accounts');
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->foreign('bank_cashback_id')->references('id')->on('cashbacks');
            $table->foreign('merchant_commission_id')->references('id')->on('merchant_commissions');
            $table->foreign('bank_id')->references('id')->on('banks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('merchants', function (Blueprint $table) {
            //
        });
    }
}
