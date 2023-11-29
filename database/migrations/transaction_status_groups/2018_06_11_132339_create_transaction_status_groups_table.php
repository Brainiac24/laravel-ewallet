<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionStatusGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_status_groups', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('code',150)->unique();
            $table->string('name',255);
            $table->string('color',255)->nullable();
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
        Schema::dropIfExists('transaction_status_groups');
    }
}
