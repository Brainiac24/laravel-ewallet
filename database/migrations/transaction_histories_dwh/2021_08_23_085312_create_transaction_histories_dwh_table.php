<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionHistoriesDwhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_histories_dwh', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('parent_id')->nullable();
            $table->uuid('transaction_id');
            $table->uuid('from_account_id')->nullable();
            $table->uuid('to_account_id')->nullable();
            $table->uuid('service_id');
            $table->decimal('amount',11,4)->default(0);
            $table->string('from_current_iso_name')->nullable();
            $table->decimal('commission',11,4)->default(0)->nullable();
            $table->decimal('converted_amount',11,4)->default(0);
            $table->string('to_currency_iso_name')->nullable();
            $table->decimal('currency_rate_value',11,4)->nullable();
            $table->text('params_json')->nullable();
            $table->bigInteger('session_number');
            $table->uuid('transaction_type_id');
            $table->dateTime('finished_at')->nullable();
            $table->dateTime('next_try_at')->nullable();
            $table->uuid('created_by_user_id')->nullable();
            $table->uuid('transaction_status_id');
            $table->uuid('transaction_status_detail_id');
            $table->uuid('order_id')->nullable();
            $table->uuid('merchant_item_id')->nullable();
            $table->integer('try_count')->default(0)->nullable();
            $table->boolean('flag')->default(0)->nullable();
            $table->longText('comment')->nullable();
            $table->string('currency_iso_name',50);
            $table->decimal('account_balance',11,4)->nullable();
            $table->longText('device_platform')->nullable();
            $table->text('cache_json')->nullable();
            $table->boolean('is_otp')->default(1);
            $table->dateTime('confirmed_at')->nullable();
            $table->string('sms_code', 6)->nullable();
            $table->dateTime('sms_code_sent_at')->nullable();
            $table->tinyInteger('sms_code_sent_count')->unsigned()->default(0)->nullable();
            $table->tinyInteger('sms_confirm_try_count')->unsigned()->default(0)->nullable();
            $table->dateTime('sms_confirm_try_at')->nullable();
            $table->boolean('add_to_favorite')->default(0)->nullable();
            $table->smallInteger('is_queued')->default(0)->nullable();
            $table->smallInteger('is_cashback_process_completed')->default(0)->nullable();
            $table->text('process_payload_json')->nullable()->default(null);
            $table->text('user_service_limit_json')->nullable()->default(null);
            $table->string('session_in')->nullable();
            $table->longText('request')->nullable();
            $table->longText('response')->nullable();
            $table->timestamps();
            $table->uuid('transaction_sync_status_id')->nullable();

            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('transaction_type_id')->references('id')->on('transaction_types');
            $table->foreign('transaction_status_id')->references('id')->on('transaction_status');
            $table->foreign('transaction_status_detail_id')->references('id')->on('transaction_status_details');
            $table->foreign('transaction_sync_status_id')->references('id')->on('transaction_sync_statuses');
            $table->index('session_number');
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
        Schema::dropIfExists('transaction_histories_dwh');
    }
}
