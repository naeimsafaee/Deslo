<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumToMusicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album_to_music', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('album_id');
            $table->unsignedBigInteger('music_id');
            $table->timestamps();
            $table->foreign('album_id')->references('id')->on('albums')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('music_id')->references('id')->on('music')
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
        Schema::dropIfExists('album_to_music');
    }
}
