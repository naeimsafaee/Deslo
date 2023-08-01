<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSubCategoriesTable extends Migration{

    public function up(){
        Schema::create('product_sub_categories', function(Blueprint $table){
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('group_category_id');
            $table->timestamps();

            $table->foreign('group_category_id')->references('id')->on('product_group_categories')->onDelete('cascade')->onUpdate('cascade');

        });
    }


    public function down(){
        Schema::dropIfExists('product_sub_categories');
    }
}
