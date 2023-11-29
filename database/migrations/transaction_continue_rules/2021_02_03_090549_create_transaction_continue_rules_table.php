<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionContinueRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_continue_rules', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('transaction_status_id');
            $table->uuid('transaction_sync_status_id')->nullable();
            $table->uuid('from_gateway_id');
            $table->uuid('to_gateway_id');
            $table->boolean('is_active')->nullable()->default(1);
            $table->timestamps();

            $table->foreign('transaction_status_id')->references('id')->on('transaction_status');
            $table->foreign('transaction_sync_status_id', 'tr_sync_status_id')->references('id')->on('transaction_sync_statuses');
            $table->foreign('from_gateway_id')->references('id')->on('gateways');
            $table->foreign('to_gateway_id')->references('id')->on('gateways');
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_continue_rules');
    }
}
