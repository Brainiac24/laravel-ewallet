<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_histories', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('transaction_id');
            $table->uuid('from_account_id')->nullable();
            $table->uuid('to_account_id')->nullable();
            $table->uuid('service_id');
            $table->decimal('amount',11,4)->default(0);
            $table->decimal('commission',11,4)->default(0)->nullable();
            $table->text('params_json')->nullable();
            $table->bigInteger('session_number');
            $table->uuid('transaction_type_id');
            $table->dateTime('finished_at')->nullable();
            $table->dateTime('next_try_at')->nullable();
            $table->uuid('created_by_user_id')->nullable();
            $table->uuid('transaction_status_id');
            $table->uuid('transaction_status_detail_id');
            $table->integer('try_count')->default(0)->nullable();
            $table->boolean('flag')->default(0)->nullable();
            $table->longText('comment')->nullable();
            $table->decimal('currency_rate_value',11,4)->default(0)->nullable();
            $table->string('currency_iso_name',50);
            $table->decimal('account_balance',11,4)->default(0)->nullable();
            $table->longText('device_platform')->nullable();
            $table->string('sms_code', 6)->nullable();
            $table->dateTime('sms_code_sent_at')->nullable();
            $table->tinyInteger('sms_code_sent_count')->unsigned()->default(0)->nullable();
            $table->tinyInteger('sms_confirm_try_count')->unsigned()->default(0)->nullable();
            $table->dateTime('sms_confirm_try_at')->nullable();
            $table->boolean('add_to_favorite')->default(0)->nullable();
            $table->boolean('is_queued')->default(0)->nullable();
            $table->string('session_in')->nullable();
            $table->longText('request')->nullable();
            $table->longText('response')->nullable();

            $table->timestamps();

            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->foreign('from_account_id')->references('id')->on('accounts');
            $table->foreign('to_account_id')->references('id')->on('accounts');
            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('transaction_type_id')->references('id')->on('transaction_types');
            $table->foreign('created_by_user_id')->references('id')->on('users');
            $table->foreign('transaction_status_id')->references('id')->on('transaction_status');
            $table->foreign('transaction_status_detail_id')->references('id')->on('transaction_status_details');
            
            $table->index('session_number');
            //$table->dropPrimary('transactions_session_number_primary');
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
        Schema::dropIfExists('transaction_histories');
    }
}
