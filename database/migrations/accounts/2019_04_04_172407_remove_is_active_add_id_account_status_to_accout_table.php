<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveIsActiveAddIdAccountStatusToAccoutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounts', function (Blueprint $table) {
            //
            $table->uuid('account_status_id')->after('params_json')->default(config('app_settings.default_account_status_work'));
            $table->foreign('account_status_id')->references('id')->on('account_status');

            $table->dropColumn('is_active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounts', function (Blueprint $table) {
            //
            $table->uuid('is_active');
        });
    }
}
