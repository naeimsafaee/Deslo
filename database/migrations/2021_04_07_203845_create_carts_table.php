<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration{

    public function up(){
        Schema::create('carts', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->integer('count')->default(1);
            $table->unsignedBigInteger('client_id')->nullable();
            $table->ipAddress('ip')->nullable();
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('carts');
    }
}
