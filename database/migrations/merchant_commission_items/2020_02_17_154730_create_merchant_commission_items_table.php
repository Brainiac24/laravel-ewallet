<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantCommissionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_commission_items', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name', 255);
            $table->decimal('min', 11, 4);
            $table->decimal('max', 11, 4);
            $table->decimal('value', 11, 4);
            $table->boolean('is_percentage')->nullable()->default(1);
            $table->uuid('merchant_commission_id');
            $table->boolean('is_active')->nullable()->default(1);

            $table->timestamps();

            $table->foreign('merchant_commission_id')->references('id')->on('merchant_commissions');
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
        Schema::dropIfExists('merchant_commission_items');
    }
}
