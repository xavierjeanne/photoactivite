<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicenceActivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licence_actives', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->timestamps();
            $table->boolean('active');
            $table->integer('licence_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('licence_id')->references('id')
                ->on('licences')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreign('user_id')->references('id')
                ->on('users')
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
        Schema::dropIfExists('licence_actives');
    }
}
