<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_user_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->enum('can_create',['0', '1'])->default('0')->comment('From this we can check the permissions for access user!');
            $table->enum('can_read',['0', '1'])->default('0')->comment('From this we can check the permissions for access user!');
            $table->enum('can_update',['0', '1'])->default('0')->comment('From this we can check the permissions for access user!');
            $table->enum('can_delete',['0', '1'])->default('0')->comment('From this we can check the permissions for access user!');
            $table->text('module')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('admin_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
