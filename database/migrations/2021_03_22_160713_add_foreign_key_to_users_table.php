<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('licence_active_id')->unsigned()->index();
            $table->integer('avatar_id')->unsigned()->index();
            $table->integer('parent_id')->unsigned()->index();
            $table->integer('role_id')->unsigned()->index();
            $table->foreign('licence_active_id')->references('id')
                ->on('licence_actives')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreign('avatar_id')->references('id')
                ->on('avatars')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreign('parent_id')->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreign('role_id')->references('id')
                ->on('roles')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
