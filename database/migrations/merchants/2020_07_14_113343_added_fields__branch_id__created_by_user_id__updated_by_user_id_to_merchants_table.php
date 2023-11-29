<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddedFieldsBranchIdCreatedByUserIdUpdatedByUserIdToMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchants', function (Blueprint $table) {
            $table->uuid("branch_id")->nullable()->after("bank_id");
            $table->uuid("created_by_user_id")->nullable()->before("created_at");
            $table->uuid("updated_by_user_id")->nullable()->before("created_at");
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('created_by_user_id')->references('id')->on('users');
            $table->foreign('updated_by_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
