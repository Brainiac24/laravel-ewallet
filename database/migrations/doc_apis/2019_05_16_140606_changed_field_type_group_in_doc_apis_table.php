<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangedFieldTypeGroupInDocApisTable extends Migration
{

    public function up()
    {
        Schema::table('doc_apis', function (Blueprint $table) {
            $table->float('group')->change();
        });
    }

    public function down()
    {
        //
    }
}
