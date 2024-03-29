<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicenceFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licence_fields', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('field_id')->unsigned()->index();
            $table->foreign('field_id')->references('id')
                ->on('fields')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->integer('licence_id')->unsigned()->index();
            $table->foreign('licence_id')->references('id')
                ->on('licences')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('licence_fields');
    }
}
