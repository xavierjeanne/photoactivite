<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_categories', function (Blueprint $table) {
            $table->increments()->unsigned();
            $table->integer('photo_id')->unsigned()->index();
            $table->integer('category_id')->unsigned()->index();
            $table->foreign('photo_id')->references('id')
                ->on('photos')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreign('category_id')->references('id')
                ->on('categories')
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
        Schema::dropIfExists('photo_categories');
    }
}
