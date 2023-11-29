<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnPlatformToUnsignedToTableUserSessions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE user_sessions CHANGE COLUMN platform platform TINYINT(4) UNSIGNED NOT NULL DEFAULT 1");

        /*
        Schema::table('user_sessions', function (Blueprint $table) {
            //$table->dropColumn('platform');
            //$table->tinyInteger("platform")->unsigned()->default(1)->after("device_code")->change();

        });
        */
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
