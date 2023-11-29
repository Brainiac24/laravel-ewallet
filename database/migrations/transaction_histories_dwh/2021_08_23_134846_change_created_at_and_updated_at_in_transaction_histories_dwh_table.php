<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeCreatedAtAndUpdatedAtInTransactionHistoriesDwhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `transaction_histories_dwh` CHANGE `created_at` `created_at` TIMESTAMP(6) NULL, CHANGE `updated_at` `updated_at` TIMESTAMP(6) NULL');
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
