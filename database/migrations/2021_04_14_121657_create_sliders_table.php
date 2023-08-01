<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->text('main_image')->nullable();
            $table->text('title')->nullable();
            $table->text('brand')->nullable();
            $table->integer('price')->nullable();
            $table->integer('discount_price')->nullable();
            $table->text('video_link')->nullable();
            $table->text('video_image')->nullable();
            $table->text('image')->nullable();
            $table->text('discount')->nullable();
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
        Schema::dropIfExists('sliders');
    }
}
