<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUnverifiedUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unverified_users', function (Blueprint $table) {
            $table->uuid('id');
            $table->bigInteger('msisdn')->unique();
            $table->string('sms_code',6)->nullable();
            $table->dateTime('sms_code_sent_at')->nullable();
            $table->tinyInteger('sms_code_sent_count')->unsigned()->default(0);
            $table->tinyInteger('sms_confirm_try_count')->unsigned()->default(0);
            $table->dateTime('sms_confirm_try_at')->nullable();
            $table->tinyInteger('blocked_count')->unsigned()->default(0);
            $table->dateTime('blocked_at')->nullable();
            $table->dateTime('unblock_at')->nullable();
            $table->text('user_agent')->nullable();
            $table->string('ip')->nullable();
            $table->text('token')->nullable();
            $table->text('devices_json')->nullable();
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
        Schema::dropIfExists('unverified_users');
    }
}
