<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_fields', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->integer('activity_id')->unsigned()->index();
            $table->foreign('activity_id')->references('id')
                ->on('activities')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->integer('field_id')->unsigned()->index();
            $table->foreign('field_id')->references('id')
                ->on('fields')
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
        Schema::dropIfExists('activity_fields');
    }
}
