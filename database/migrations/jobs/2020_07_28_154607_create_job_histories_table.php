<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_histories', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->longText('payload')->nullable();
            $table->uuid('created_by_user_id');
            $table->timestamps();
            $table->dateTime('processed_at')->nullable();
            $table->dateTime('finished_at')->nullable();
            $table->string('filename')->nullable();
            $table->string('error_message')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->foreign('created_by_user_id')->references('id')->on('users');
            $table->primary('id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_histories');
    }
}
