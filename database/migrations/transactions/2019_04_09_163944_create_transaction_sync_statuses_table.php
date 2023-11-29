<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionSyncStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_sync_statuses', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('code', 150)->nullable()->unique();
            $table->string('code_map', 150)->nullable()->unique();
            $table->string('name', 255)->nullable();
            $table->text('desc')->nullable();
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
        Schema::dropIfExists('transaction_sync_statuses');
    }
}
