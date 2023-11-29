<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewTableMerchants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name',255);
            $table->uuid('parent_id')->index()->default('00000000-0000-0000-0000-000000000000');
            $table->string('correspondent_account',50);
            $table->string('bic',50);
            $table->string('phone',50);
            $table->string('address',255);
            $table->string('email',50)->nullable();
            $table->bigInteger('account_number');
            $table->boolean('is_active')->default(1);

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
        Schema::dropIfExists('merchants');
    }
}
