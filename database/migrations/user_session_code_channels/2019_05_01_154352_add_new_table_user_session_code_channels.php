<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewTableUserSessionCodeChannels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_session_code_channels', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('code', 255);
            $table->string('name', 255);
            $table->boolean('is_active')->nullable()->default(1);

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
        Schema::dropIfExists('user_session_code_channels');
    }
}
