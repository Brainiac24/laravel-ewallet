<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderAccountTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_account_types', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('code', 150)->nullable();
            $table->string('code_map', 150)->unique()->nullable();
            $table->string('name', 255)->nullable();
            $table->text('icon')->nullable();
            $table->double('position')->default(0);
            $table->boolean('is_active')->nullable()->default(1);
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
        Schema::dropIfExists('order_account_types');
    }
}
