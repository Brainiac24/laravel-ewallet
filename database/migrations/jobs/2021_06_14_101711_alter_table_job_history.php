<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableJobHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE job_histories
   CHANGE created_by_user_id created_by_user_id CHAR(36) NULL ');
        Schema::table('job_histories', function (Blueprint $table) {
            $table->string('type')->default(\App\Services\Common\Helpers\JobHistoryType::EXPORT)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_histories', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
