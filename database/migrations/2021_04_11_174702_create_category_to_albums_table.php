<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryToAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_to_albums', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('album_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();
            $table->foreign('album_id')->references('id')->on('albums')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('category_id')->references('id')->on('music_categories')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_to_albums');
    }
}
