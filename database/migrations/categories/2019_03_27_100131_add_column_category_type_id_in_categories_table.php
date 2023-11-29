<?php

use App\Services\Common\Helpers\CategoryType as CATEGORYTYPES;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnCategoryTypeIdInCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            //
            $table->uuid('category_type_id')->after('parent_id')->default(CATEGORYTYPES::MENU_DEFAULT_ID);
            $table->foreign('category_type_id')->references('id')->on('category_types');
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
