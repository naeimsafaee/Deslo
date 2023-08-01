<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductGroupCategoriesTable extends Migration{

    public function up(){
        Schema::create('product_group_categories', function(Blueprint $table){
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('product_categories')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    public function down(){
        Schema::dropIfExists('product_group_categories');
    }
}
