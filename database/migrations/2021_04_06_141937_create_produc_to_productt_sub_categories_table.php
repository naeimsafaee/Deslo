<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducToProducttSubCategoriesTable extends Migration{

    public function up(){
        Schema::create('product_to_product_sub_categories', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('subcategory_id')->references('id')->on('product_sub_categories')->onDelete('cascade')->onUpdate('cascade');

        });
    }


    public function down(){
        Schema::dropIfExists('produc_to_productt_sub_categories');
    }
}
