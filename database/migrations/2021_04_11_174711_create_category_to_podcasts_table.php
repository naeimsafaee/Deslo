<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryToPodcastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_to_podcasts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('podcast_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();
            $table->foreign('podcast_id')->references('id')->on('podcasts')
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
        Schema::dropIfExists('category_to_podcasts');
    }
}
