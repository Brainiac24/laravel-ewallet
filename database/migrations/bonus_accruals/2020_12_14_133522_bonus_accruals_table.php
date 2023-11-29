<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BonusAccrualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonus_accruals', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('cashback_id');
            $table->uuid('user_id');
            $table->uuid('transaction_id')->nullable();
            $table->uuid('order_id')->nullable();
            $table->uuid('bonus_accrual_status_id');

            $table->foreign('cashback_id')->references('id')->on('cashbacks');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('bonus_accrual_status_id')->references('id')->on('bonus_accrual_statuses');

            $table->timestamps();
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
        //
    }
}
