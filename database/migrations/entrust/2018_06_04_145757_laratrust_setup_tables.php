<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class LaratrustSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        // Create table for storing roles
        Schema::create('roles', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->string('display_name');
            $table->text('description')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->primary('id');
        });

        // Create table for storing permissions
        Schema::create('permissions', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();

            $table->primary('id');
        });

        // Create table for associating roles to users and teams (Many To Many Polymorphic)
        Schema::create('role_user', function (Blueprint $table) {
            $table->uuid('role_id');
            $table->uuid('user_id');
            $table->string('user_type');

            $table->foreign('role_id')->references('id')->on('roles');
                //->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');

            $table->primary(['user_id', 'role_id', 'user_type']);
        });

        // Create table for associating permissions to users (Many To Many Polymorphic)
        Schema::create('perm_user', function (Blueprint $table) {
            $table->uuid('permission_id');
            $table->uuid('user_id');
            $table->string('user_type');

            $table->foreign('permission_id')->references('id')->on('permissions');
                //->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');

            $table->primary(['user_id', 'permission_id', 'user_type']);
        });

        // Create table for associating permissions to roles (Many-to-Many)
        Schema::create('perm_role', function (Blueprint $table) {
            $table->uuid('permission_id');
            $table->uuid('role_id');

            $table->foreign('permission_id')->references('id')->on('permissions');
                //->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles');
                //->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['permission_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::dropIfExists('perm_user');
        Schema::dropIfExists('perm_role');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('roles');
    }
}
