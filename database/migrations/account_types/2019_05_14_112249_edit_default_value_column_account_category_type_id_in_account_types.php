<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditDefaultValueColumnAccountCategoryTypeIdInAccountTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('account_types', function (Blueprint $table) {
            //
            $table->string('account_category_type_id', 36)->default(config('app_settings.default_account_category_type_ewallet_id'))->change();
            $table->foreign('account_category_type_id')->references('id')->on('account_category_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('account_types', function (Blueprint $table) {
            //
        });
    }
}
