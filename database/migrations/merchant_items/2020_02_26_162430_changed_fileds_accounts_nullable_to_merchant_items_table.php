<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangedFiledsAccountsNullableToMerchantItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `merchant_items` CHANGE `account_id` `account_id` CHAR(36) CHARSET utf8mb4 COLLATE utf8mb4_unicode_ci NULL");
        DB::statement("ALTER TABLE `merchant_items` CHANGE `account_number` `account_number` VARCHAR(191) CHARSET utf8mb4 COLLATE utf8mb4_unicode_ci NULL");

        /*Schema::table('merchant_items', function (Blueprint $table) {
            $table->uuid('account_id')->nullable()->change();
            $table->bigInteger('account_number')->nullable()->change();
        });*/
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
