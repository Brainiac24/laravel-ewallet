<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddedFieldsIsActiveAndInfoParamsJsonToAttestations extends Migration
{
    
    public function up()
    {
        Schema::table('attestations', function (Blueprint $table) {
            $table->text('info_params_json')->after('params_json');
            $table->boolean('is_active')->default(1)->after('name');
        });
    }

    public function down()
    {
        //
    }
}
