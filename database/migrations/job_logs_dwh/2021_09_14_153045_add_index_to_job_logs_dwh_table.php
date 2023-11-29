<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexToJobLogsDwhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_logs_dwh', function (Blueprint $table){
            $table->index('created_at');
            $table->index('transaction_id');
            $table->index('order_id');
            $table->index('type');
            $table->index('is_completed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_logs_dwh', function (Blueprint $table){
            $table->dropIndex('created_at');
            $table->dropIndex('transaction_id');
            $table->dropIndex('order_id');
            $table->dropIndex('type');
            $table->dropIndex('is_completed');
        });
    }
}
