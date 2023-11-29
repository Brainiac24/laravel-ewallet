<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddedColumnsProcessPayloadTransactionSyncStatusIdChangeIsQueuedType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_histories', function (Blueprint $table) {
            $table->string('process_payload')->nullable()->after('is_queued')->default(null);
            $table->uuid('transaction_sync_status_id')->nullable();
            $table->smallInteger('is_queued')->change();

            $table->foreign('transaction_sync_status_id')->references('id')->on('transaction_sync_statuses');
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
