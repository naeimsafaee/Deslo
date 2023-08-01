<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentPodcastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_podcasts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('podcast_id');
            $table->unsignedBigInteger('client_id');
            $table->text('description');
            $table->boolean('is_active');
            $table->timestamps();

            $table->foreign('podcast_id')->references('id')->on('podcasts')
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
        Schema::dropIfExists('comment_podcasts');
    }
}
