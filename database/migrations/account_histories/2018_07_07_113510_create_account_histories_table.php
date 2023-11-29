<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_histories', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('account_id');
            $table->bigInteger('number');
            $table->decimal('amount',11,4)->default(0);
            $table->decimal('commission',11,4)->default(0)->nullable();
            $table->decimal('balance',11,4)->default(0);
            $table->decimal('blocked_balance',11,4)->default(0);
            $table->uuid('account_type_id');
            $table->uuid('currency_id');
            $table->decimal('currency_rate_value',11,4)->default(0)->nullable();
            $table->uuid('transaction_type_id')->nullable();
            $table->uuid('transaction_id')->nullable();
            $table->uuid('transaction_status_id')->nullable();
            $table->uuid('created_by_user_id');
            $table->timestamps();
                        
            $table->foreign('account_type_id')->references('id')->on('account_types');
            $table->foreign('created_by_user_id')->references('id')->on('users');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->foreign('transaction_type_id')->references('id')->on('transaction_types');
            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->foreign('transaction_status_id')->references('id')->on('transaction_status');
            $table->foreign('account_id')->references('id')->on('accounts');

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
        Schema::dropIfExists('account_histories');
    }
}
