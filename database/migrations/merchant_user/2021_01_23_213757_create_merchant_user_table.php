<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_user', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('user_id');
            $table->uuid('user_business_account_id');
            $table->uuid('merchant_id');
            $table->boolean('is_approved')->default(0);
            $table->boolean('is_active')->default(1);

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('user_business_account_id')->references('id')->on('accounts');
            $table->foreign('merchant_id')->references('id')->on('merchants');

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
        Schema::dropIfExists('merchant_user');
    }
}
