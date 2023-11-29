<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_status', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('code', 150)->unique();
            $table->string('name', 255);
            $table->string('color', 255)->nullable();
            $table->uuid('transaction_status_group_id');
            $table->timestamps();

            $table->foreign('transaction_status_group_id')->references('id')->on('transaction_status_groups');

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
        Schema::dropIfExists('transaction_status');
    }
}
