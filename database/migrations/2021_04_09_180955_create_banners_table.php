<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration{

    public function up(){
        Schema::create('banners', function(Blueprint $table){
            $table->id();
            $table->string('title')->nullable();
            $table->text('image')->nullable();
            $table->string('color_code')->nullable();
            $table->text('link')->nullable();
            $table->string('price')->nullable();
            $table->string('price_1')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }


    public function down(){
        Schema::dropIfExists('banners');
    }
}
