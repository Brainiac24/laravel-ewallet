<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionSyncRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_sync_rules', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('from_gateway_id')->nullable();
            $table->uuid('to_gateway_id')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();

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
        Schema::dropIfExists('transaction_sync_rules');
    }
}
