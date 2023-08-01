<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentMusicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_music', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('music_id');
            $table->unsignedBigInteger('client_id');
            $table->text('description');
            $table->boolean('is_active');
            $table->timestamps();

            $table->foreign('music_id')->references('id')->on('music')
                ->onDelete('cascade')->onUpdate('cascade');        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_music');
    }
}
