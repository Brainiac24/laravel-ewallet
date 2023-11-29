<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->uuid('id');
            $table->bigInteger('number')->unique();
            $table->decimal('balance',11,4)->default(0);
            $table->decimal('blocked_balance',11,4)->default(0);
            $table->boolean('is_active')->nullable()->default(1);
            $table->uuid('account_type_id');
            $table->uuid('user_id');
            $table->uuid('currency_id');
            $table->timestamps();
                        
            $table->foreign('account_type_id')->references('id')->on('account_types');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('currency_id')->references('id')->on('currencies');

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
        Schema::dropIfExists('accounts');
    }
}
