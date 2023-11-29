<?php

use App\Services\Common\Helpers\CashbackType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddedFieldCashbackTypeIdToCashbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cashbacks', function (Blueprint $table) {
            $table->uuid('cashback_type_id')->after('is_active')->default(CashbackType::CASHBACK);
            $table->foreign('cashback_type_id')->references('id')->on('cashback_types');
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
