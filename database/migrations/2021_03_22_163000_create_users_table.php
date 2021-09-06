<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments();
            $table->string('name');
            $table->string('last_name');
            $table->string('address')->nullable();
            $table->string('address_bis')->nullable();
            $table->integer('postal_code')->nullable();
            $table->string('country')->nullable();
            $table->integer('phone')->nullable();
            $table->string('siret')->nullable();
            $table->string('company')->nullable();
            $table->timestamp('dateofbirth')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
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
        Schema::dropIfExists('users');
    }
}
