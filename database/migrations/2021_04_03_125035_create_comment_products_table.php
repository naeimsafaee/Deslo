<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentProductsTable extends Migration{

    public function up(){
        Schema::create('comment_products', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('product_id');
            $table->text('text');
            $table->float('rate')->default(0);
            $table->boolean('is_active')->default(false);
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    public function down(){
        Schema::dropIfExists('comment_products');
    }
}
