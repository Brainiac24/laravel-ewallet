<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnIconAndYearToTableOrderCardTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_card_types', function (Blueprint $table) {
            //
            $table->integer('year')->after('code_ibank')->default(1);
            $table->text('icon')->after('year')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_card_types', function (Blueprint $table) {
            //
        });
    }
}
