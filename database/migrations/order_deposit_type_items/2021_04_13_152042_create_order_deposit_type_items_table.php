<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDepositTypeItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * 
     */
    public function up()
    {
        Schema::create('order_deposit_type_items', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('code', 150)->nullable();
            $table->string('code_map', 150)->unique()->nullable();
            $table->string('name', 255)->nullable();
            $table->decimal('min_amount', 14, 4)->default(0);
            $table->decimal('max_amount', 14, 4)->default(0);
            $table->integer('day_from_count');
            $table->integer('day_to_count');
            $table->decimal('percentage', 14, 4);
            $table->decimal('can_fill_until', 14, 4);
            $table->boolean('can_fill_until_is_persentage')->nullable()->default(1);
            $table->uuid('currency_id');
            $table->uuid('order_deposit_type_id');
            $table->double('position')->default(1);
            $table->boolean('is_active')->nullable()->default(1);
            $table->timestamps();

            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->foreign('order_deposit_type_id')->references('id')->on('order_deposit_types');

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
        Schema::dropIfExists('order_deposit_type_items');
    }
}
