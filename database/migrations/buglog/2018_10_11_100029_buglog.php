<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Buglog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buglogs', function (Blueprint $table) {
            $table->uuid('id');
            $table->text('tag')->nullable();
            $table->text('link')->nullable();
            $table->text('response')->nullable();
            $table->text('error')->nullable();
            $table->text('token')->nullable();
            $table->text('os')->nullable();
            $table->text('version')->nullable();
            $table->text('msisdn')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('buglogs');
    }
}
