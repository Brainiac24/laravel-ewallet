<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemovedForeignKeyCreatedByUserFromaccountToaccountIdInTransactionHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_histories', function (Blueprint $table) {
            $table->dropForeign('transaction_histories_created_by_user_id_foreign');
            $table->dropForeign('transaction_histories_from_account_id_foreign');
            $table->dropForeign('transaction_histories_to_account_id_foreign');
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

        });
    }
}
