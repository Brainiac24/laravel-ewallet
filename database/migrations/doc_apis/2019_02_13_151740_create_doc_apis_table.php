<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocApisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_apis', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name',255);
            $table->text('url_path');
            $table->text('method');
            $table->text('params');
            $table->text('response_success_json');
            $table->text('response_reject_json');
            $table->string('version',100);
            $table->integer('group');
            $table->uuid('doc_api_category_id');
            $table->text('desc')->nullable();
            $table->boolean('is_active')->nullable()->default(1);
            $table->timestamps();

            $table->foreign('doc_api_category_id')->references('id')->on('doc_api_categories');

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
        Schema::dropIfExists('doc_apis');
    }
}
