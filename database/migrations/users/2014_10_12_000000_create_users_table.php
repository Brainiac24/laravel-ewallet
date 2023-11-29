<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('username')->unique();
            $table->string('email')->unique()->nullable();
            $table->text('photo')->nullable();
            $table->string('tmp_email')->nullable();
            $table->bigInteger('msisdn')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->uuid('attestation_id');
            $table->string('sms_code', 6)->nullable();
            $table->dateTime('sms_code_sent_at')->nullable();
            $table->tinyInteger('sms_code_sent_count')->unsigned()->default(0);
            $table->tinyInteger('sms_confirm_try_count')->unsigned()->default(0);
            $table->dateTime('sms_confirm_try_at')->nullable();
            $table->string('email_code', 6)->nullable();
            $table->dateTime('email_code_sent_at')->nullable();
            $table->tinyInteger('email_code_sent_count')->unsigned()->default(0);
            $table->tinyInteger('email_confirm_try_count')->unsigned()->default(0);
            $table->dateTime('email_confirm_try_at')->nullable();
            $table->dateTime('email_send_unblock_at')->nullable();
            $table->string('pin', 5000)->nullable();
            $table->tinyInteger('pin_confirm_try_count')->unsigned()->default(0);
            $table->dateTime('pin_confirm_try_at')->nullable();
            $table->tinyInteger('pin_change_try_count')->unsigned()->default(0);
            $table->dateTime('pin_change_try_at')->nullable();
            $table->dateTime('pin_change_unblock_at')->nullable();
            $table->tinyInteger('blocked_count')->unsigned()->default(0);
            $table->dateTime('blocked_at')->nullable();
            $table->dateTime('unblock_at')->nullable();
            $table->dateTime('last_login_at')->nullable();
            $table->timestamps();
            $table->boolean('is_auth')->default(0);
            $table->boolean('is_admin')->default(0);
            $table->boolean('is_active')->default(0);
            $table->text('limits_json')->nullable();
            $table->text('contacts_json')->nullable();
            $table->text('user_settings_json')->nullable();
            $table->text('devices_json')->nullable();
            $table->text('description')->nullable();
            $table->string('ip')->nullable();
            $table->rememberToken();

            $table->foreign('attestation_id')->references('id')->on('attestations');
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
        Schema::dropIfExists('users');
    }
}
