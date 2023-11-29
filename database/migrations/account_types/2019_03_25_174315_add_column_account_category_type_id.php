<?php

use App\Services\Common\Helpers\AccountCategoryTypes as ACCOUNTCATEGORYTYPES;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnAccountCategoryTypeId extends Migration
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
//            $table->uuid('account_category_type_id')->after('gateway_id')->default(ACCOUNTCATEGORYTYPES::ACCOUNT_ID);
            $table->uuid('account_category_type_id')->after('gateway_id')->default(config('app_settings.default_account_category_type_accounts_id'));
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
//            $table->dropForeign("account_types_account_category_type_id_foreign");
//            $table->dropIndex("account_types_account_category_type_id_foreign");
        });
    }
}
