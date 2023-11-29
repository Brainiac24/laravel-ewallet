<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TransactionContinueRuleAccordanceAlterMessageLength extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_continue_rule_accordance', function (Blueprint $table){
           $table->string('message',510)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_continue_rule_accordance', function (Blueprint $table){
            $table->string('message',255)->nullable()->change();
        });
    }
}
