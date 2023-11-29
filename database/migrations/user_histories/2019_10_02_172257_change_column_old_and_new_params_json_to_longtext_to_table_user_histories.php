<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnOldAndNewParamsJsonToLongtextToTableUserHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_histories', function (Blueprint $table) {
            $table->longText('old_params_json')->nullable()->comment(' ')->change();
            $table->longText('new_params_json')->nullable()->comment(' ')->change();
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
