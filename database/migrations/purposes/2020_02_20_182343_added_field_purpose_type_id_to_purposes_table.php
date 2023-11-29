<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddedFieldPurposeTypeIdToPurposesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purposes', function (Blueprint $table) {
            //
            $table->uuid('purpose_type_id')->default('a0ed4a36-a2df-47f1-b3aa-9a209b025680')->after('is_active'); // TRANSFER

            $table->foreign('purpose_type_id')->references('id')->on('purpose_types');
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
