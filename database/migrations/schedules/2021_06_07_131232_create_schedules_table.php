<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->string('cron_expression');
            $table->uuid('create_by_user_id');
            $table->uuid('schedule_type_id');
            $table->boolean('is_active')->default(1);
            $table->timestamps();
            $table->primary('id');
            $table->foreign('schedule_type_id')->references('id')->on('schedule_types');
            $table->foreign('create_by_user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
