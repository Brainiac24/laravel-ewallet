<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionContinueRuleAccordanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_continue_rule_accordance', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('transaction_continue_rule_id');
            $table->uuid('transaction_status_id')->nullable();
            $table->uuid('transaction_sync_status_id')->nullable();
            $table->string('message')->nullable();
            $table->mediumText('allowed_users')->nullable();
            $table->boolean('is_active')->nullable()->default(1);
            $table->timestamps();

            $table->foreign('transaction_status_id','tr_status_id')->references('id')->on('transaction_status');
            $table->foreign('transaction_continue_rule_id', 'tr_continue_id')->references('id')->on('transaction_continue_rules');
            $table->foreign('transaction_sync_status_id', 'tran_sync_status_id')->references('id')->on('transaction_sync_statuses');
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
        Schema::dropIfExists('transaction_continue_rule_accordance');
    }
}
