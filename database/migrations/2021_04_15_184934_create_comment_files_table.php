<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('comment_id');
            $table->text('file');
            $table->timestamps();
//
//            $table->foreign('comment_id')->references('id')->on('CommentProduct')
//                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_files');
    }
}
