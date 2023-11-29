<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnPlatformToTableUserSessions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_sessions', function (Blueprint $table) {
            $table->string("device_code")->nullable()->after("user_id");
            $table->tinyInteger("platform")->unsigned()->default(1)->after("device_code");
            $table->string("device_params_json")->nullable()->after("platform");

            $table->index("platform");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_sessions', function (Blueprint $table) {
            //
        });
    }
}
