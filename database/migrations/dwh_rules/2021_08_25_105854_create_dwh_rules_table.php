<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDwhRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dwh_rules', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('table',75);
            $table->integer('job_log_type')->nullable();
            $table->integer('to_dwh_days')->nullable()->comment('interval in days');
            $table->integer('delete_from_dwh_days')->nullable()->comment('interval in days');

            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dwh_rules');
    }
}
