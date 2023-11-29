<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangedTableMerchants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchants', function (Blueprint $table) {
            //
            $table->uuid('merchant_category_id')->default(config('app_settings.default_merchant_category_id'))->after('account_number');
            //Default Khujand
            $table->uuid('city_id')->default('507b9d5b-25b2-4b8e-9db6-98ee8bfb986f')->after('merchant_category_id');
            $table->string('latitude',30)->nullable()->after('city_id');
            $table->string('longtitude',30)->nullable()->after('latitude');
            $table->double('position')->nullable()->after('longtitude');
            $table->uuid('merchant_workday_id')->nullable()->after('position');
            $table->integer('user_count')->default(0)->after('merchant_workday_id');
            $table->double('highest_cashback_value')->nullable()->after('user_count');
            $table->uuid('cashback_id')->nullable()->after('highest_cashback_value');

            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('merchant_category_id')->references('id')->on('merchant_categories');
            $table->foreign('merchant_workday_id')->references('id')->on('merchant_workdays');
            $table->foreign('cashback_id')->references('id')->on('cashbacks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('merchants', function (Blueprint $table) {
            //
        });
    }
}
