<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableJobLogsNewTemporary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_logs_new_temp', function (Blueprint $table) {
            $table->uuid('id');

            $table->string('transaction_id')->nullable()->default(null)->index();
            $table->string('order_id')->nullable()->default(null)->index();

            $table->longText('params_json')->nullable();
            $table->longText('client_request_log')->nullable();
            $table->longText('client_response')->nullable();
            $table->boolean("is_error")->default(0);
            $table->text("error_message")->nullable()->default(null);

            $table->smallInteger('child_to_process_count')->default(0);
            $table->smallInteger('child_processed_count')->default(0);
            $table->smallInteger('type')->index();
            $table->boolean('is_completed')->default(0)->index();
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

            $table->index('created_at');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_logs_new_temp');
    }
}
