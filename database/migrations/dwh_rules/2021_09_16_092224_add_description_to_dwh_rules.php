<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescriptionToDwhRules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dwh_rules', function (Blueprint $table){
           $table->string('description', 400)->nullable()->after('job_log_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dwh_rules', function (Blueprint $table){
            $table->dropColumn('description', 400);
        });
    }
}
