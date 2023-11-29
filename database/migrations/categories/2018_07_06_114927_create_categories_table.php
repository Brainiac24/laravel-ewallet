<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('code',150)->unique();
            $table->string('name',255);
            $table->boolean('is_active')->default(1);
            $table->boolean('is_enabled')->default(1);
            $table->integer('position')->default(1);
            $table->uuid('parent_id')->index();
            $table->text('icon_url')->nullable();
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
        Schema::dropIfExists('categories');
    }
}
