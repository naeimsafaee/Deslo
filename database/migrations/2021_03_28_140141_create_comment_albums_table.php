<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_albums', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('album_id');
            $table->unsignedBigInteger('client_id');
            $table->text('description');
            $table->boolean('is_active');
            $table->timestamps();

            $table->foreign('album_id')->references('id')->on('albums')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('client_id')->references('id')->on('clients')
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
        Schema::dropIfExists('comment_albums');
    }
}
