<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductGuaraniesTable extends Migration{

    public function up(){
        Schema::create('product_guaranies', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger("product_id");
            $table->unsignedBigInteger('guarany_id');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('guarany_id')->references('id')->on('guaranies')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    public function down(){
        Schema::dropIfExists('product_guaranies');
    }
}
