<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewTableMerchantWorkdays extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_workdays', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name',255);
            $table->string('monday',10);
            $table->string('tuesday',10);
            $table->string('wednesday',10);
            $table->string('thursday',10);
            $table->string('friday',10);
            $table->string('saturday',10);
            $table->string('sunday',10);
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
        Schema::dropIfExists('merchant_workdays');
    }
}
