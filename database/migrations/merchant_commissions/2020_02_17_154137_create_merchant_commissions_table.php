<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_commissions', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name', 255);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
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
        Schema::dropIfExists('merchant_commissions');
    }
}
