<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexToTransactionHistoriesDwhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_histories_dwh', function (Blueprint $table){
            $table->index('from_account_id');
            $table->index('to_account_id');
            $table->index('created_by_user_id');
            $table->index('order_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_histories_dwh', function (Blueprint $table){
            $table->dropIndex('from_account_id');
            $table->dropIndex('to_account_id');
            $table->dropIndex('created_by_user_id');
            $table->dropIndex('order_id');

        });
    }
}
