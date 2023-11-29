<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUserSessions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_sessions', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('user_id')->unique();
            $table->string('access_token', 4096)->nullable();
            $table->dateTime('access_token_expires_at')->nullable();
            $table->string('refresh_token', 4096)->nullable();
            $table->dateTime('refresh_token_expires_at')->nullable();
            $table->dateTime('revoked_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('user_sessions');
    }
}
