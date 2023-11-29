<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangedFieldsToDecimalToCashbackItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cashback_items', function (Blueprint $table) {
            $table->decimal('min', 11, 4)->change();
            $table->decimal('max', 11, 4)->change();
            $table->decimal('value', 11, 4)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
