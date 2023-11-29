<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewTableTransferList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_lists', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('code', 150)->unique()->nullable();
            $table->string('code_map', 150)->unique()->nullable();
            $table->string('name', 255)->nullable();
            $table->text('desc')->nullable();
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
        Schema::dropIfExists('transfer_lists');
    }
}
