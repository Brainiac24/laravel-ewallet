<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobLogsDwhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_logs_dwh', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('transaction_id')->nullable();
            $table->string('order_id')->nullable();
            $table->longText('params_json')->nullable();
            $table->longText('client_request_log')->nullable();
            $table->longText('client_response')->nullable();
            $table->boolean("is_error")->default(0);
            $table->text("error_message")->nullable();
            $table->smallInteger('child_to_process_count')->default(0);
            $table->smallInteger('child_processed_count')->default(0);
            $table->smallInteger('type');
            $table->boolean('is_completed')->default(0);
            $table->boolean("is_lock")->default(0);
            $table->smallInteger('allowed_try_count');

            $table->uuid('created_by_user_id');
            $table->uuid('parent_id')->index();
            $table->longText('queue_request_log')->nullable();
            $table->longText('queue_response_log')->nullable();

            $table->string('ip')->nullable();

            $table->timestamps();
            $table->dateTime('finished_at')->nullable();

            $table->foreign('created_by_user_id')->references('id')->on('users');
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
        Schema::dropIfExists('job_logs_dwh');
    }
}
