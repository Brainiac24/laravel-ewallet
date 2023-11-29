<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewTableCashbackItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashback_items', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name', 255);
            $table->double('min');
            $table->double('max');
            $table->double('value');
            $table->boolean('is_percentage')->nullable()->default(1);
            $table->uuid('cashback_id');
            $table->boolean('is_active')->nullable()->default(1);

            $table->timestamps();

            $table->foreign('cashback_id')->references('id')->on('cashbacks');
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
        Schema::dropIfExists('cashback_items');
    }
}
