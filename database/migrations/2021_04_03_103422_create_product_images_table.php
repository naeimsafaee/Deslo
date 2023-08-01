<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductImagesTable extends Migration{

    public function up(){
        Schema::create('product_images', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->text('image');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');

        });
    }


    public function down(){
        Schema::dropIfExists('product_images');
    }
}
