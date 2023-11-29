<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewTableOrderHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_histories', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('order_id');
            $table->uuid('order_type_id');
            $table->double('number');
            $table->uuid('from_user_id');
            $table->uuid('to_user_id')->nullable();
            $table->string('entity_type')->nullable();
            $table->uuid('entity_id')->nullable();
            $table->text('payload_params_json')->nullable();
            $table->longText('response')->nullable();
            $table->uuid('order_status_id');
            $table->uuid('order_process_status_id')->nullable();
            $table->smallInteger('is_queued')->default(0)->nullable();

            $table->timestamps();
            $table->primary('id');

            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_histories');
    }
}
