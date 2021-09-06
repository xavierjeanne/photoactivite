<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_categories', function (Blueprint $table) {
            $table->increments()->unsigned();
            $table->integer('category_photo_id')->unsigned()->index();
            $table->foreign('category_photo_id')->references('id')
                ->on('photo_categories')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->integer('activity_id')->unsigned()->index();
            $table->foreign('activity_id')->references('id')
                ->on('activities')
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
        Schema::dropIfExists('activity_categories');
    }
}
