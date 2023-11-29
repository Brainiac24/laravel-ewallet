<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewTablePurposes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purposes', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('code', 150)->nullable()->unique();
            $table->string('code_map', 150)->unique();
            $table->string('name', 255)->nullable();
            $table->text('desc')->nullable();
            $table->boolean('is_active')->nullable()->default(1);

            $table->primary('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purposes');
    }
}
