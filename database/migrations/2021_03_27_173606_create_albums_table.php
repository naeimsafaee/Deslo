<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->text('image')->nullable();
            $table->string('title');
            $table->unsignedBigInteger('artist_id');
            $table->integer('price')->default(0);
            $table->integer('discount_price')->default(0);
            $table->text('description')->nullable();
            $table->text('file')->nullable();
            $table->integer('view')->default(0);
            $table->timestamps();

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
        Schema::dropIfExists('albums');
    }
}
