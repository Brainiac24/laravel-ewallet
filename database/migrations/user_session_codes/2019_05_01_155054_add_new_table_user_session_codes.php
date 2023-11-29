<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewTableUserSessionCodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_session_codes', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('value', 255);
            $table->string('code', 255);
            $table->dateTime('unblock_at')->nullable();
            $table->dateTime('blocked_at')->nullable();
            $table->dateTime('code_sent_at')->nullable();
            $table->integer('code_sent_count')->default(0);
            $table->integer('retry_send_code_try_count')->default(0);
            $table->integer('failed_confirm_try_count')->default(0);
            $table->dateTime('failed_confirm_try_at')->nullable();
            $table->uuid('user_session_code_type_id');
            $table->string('entity_type')->nullable();
            $table->uuid('entity_id')->nullable();
            $table->uuid('user_session_code_channel_id');
            $table->uuid('created_by_user_id');

            $table->timestamps();
            $table->primary('id');

            $table->index('entity_id');
            $table->foreign('user_session_code_type_id')->references('id')->on('user_session_code_types');
            $table->foreign('user_session_code_channel_id')->references('id')->on('user_session_code_channels');
            $table->foreign('created_by_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_session_codes');
    }
}
