<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomesTable extends Migration{

    public function up(){
        Schema::create('homes', function(Blueprint $table){
            $table->id();
            $table->string('title')->nullable();
            $table->enum('type' , ["product" , "brand" , "banner" , "book" , "banner2" , "blog" , "linksAndService" , "service" , "album"]);
            $table->unsignedBigInteger('sub_category_id')->nullable();
            $table->enum("order_by" , ["created_at" , "updated_at" , "price" , "discounted_price" , "final_price"])->nullable();
            $table->boolean('is_desc')->default(true);
            $table->integer('order');
            $table->timestamps();
        });
    }


    public function down(){
        Schema::dropIfExists('homes');
    }
}
