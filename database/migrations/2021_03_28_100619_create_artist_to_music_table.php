<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistToMusicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artist_to_music', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('music_id');
            $table->unsignedBigInteger('artist_id');
            $table->timestamps();
            $table->foreign('music_id')->references('id')->on('music')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('artist_id')->references('id')->on('artists')
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
        Schema::dropIfExists('artist_to_music');
    }
}
