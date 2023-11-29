<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewTableOrderComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_comments', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('order_type_id');
            $table->string('name', 255);
            $table->boolean('is_active')->nullable()->default(1);

            $table->timestamps();
            $table->primary('id');
            $table->foreign('order_type_id')->references('id')->on('order_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_comments');
    }
}
