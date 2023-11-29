<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewTableOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('order_type_id');
            $table->bigIncrements('number')->unique();
            $table->uuid('from_user_id');
            $table->uuid('to_user_id')->nullable();
            $table->string('entity_type')->nullable();
            $table->uuid('entity_id')->nullable();
            $table->text('payload_params_json')->nullable();
            $table->uuid('order_status_id');

            $table->index('number');
            $table->timestamps();
            $table->dropPrimary('orders_number_primary');
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
        Schema::dropIfExists('orders');
    }
}
