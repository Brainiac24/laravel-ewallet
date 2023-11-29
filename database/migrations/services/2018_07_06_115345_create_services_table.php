<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('code',150)->unique();;
            $table->string('processing_code', 150)->unique();
            $table->string('name', 255);
            $table->text('icon_url')->nullable();
            $table->text('params_json')->nullable();
            $table->decimal('min_amount', 11, 4)->default(0);
            $table->decimal('max_amount', 11, 4)->default(0);
            $table->boolean('is_active')->default(1);
            $table->boolean('is_enabled')->default(1);
            $table->string('requestable_balance_params',255)->nullable();
            $table->boolean('is_from_accountable')->default(1);
            $table->boolean('is_to_accountable')->default(0);
            $table->integer('position')->default(1);
            $table->uuid('service_limit_id')->nullable();
            $table->uuid('gateway_id');
            $table->uuid('workday_id')->nullable();
            $table->uuid('commission_id')->nullable();
            $table->uuid('currency_id')->nullable();

            $table->timestamps();

            $table->foreign('service_limit_id')->references('id')->on('service_limits');
            $table->foreign('gateway_id')->references('id')->on('gateways');
            $table->foreign('workday_id')->references('id')->on('workdays');
            $table->foreign('commission_id')->references('id')->on('commissions');
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
        Schema::dropIfExists('services');
    }
}
