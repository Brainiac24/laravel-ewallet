<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsExcludeForFillOnAccountTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('account_types', function(Blueprint $table){
           $table->boolean('is_exclude_for_fill')->default(false)->after('params_json');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('account_types', function(Blueprint $table){
            $table->dropColumn('is_exclude_for_fill');
        });
    }
}
