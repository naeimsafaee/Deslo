<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientProductsTable extends Migration{

    public function up(){
        Schema::create('client_products', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('client_id');
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('client_products');
    }
}
