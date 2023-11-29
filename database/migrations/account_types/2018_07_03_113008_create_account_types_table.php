<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_types', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('code',150)->unique();
            $table->string('name',255);
            $table->uuid('gateway_id');
            $table->uuid('parent_id');
            $table->timestamps();

            $table->foreign('gateway_id')->references('id')->on('gateways');
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
        Schema::dropIfExists('account_types');
    }
}
