<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanner2sTable extends Migration{

    public function up(){
        Schema::create('banner2s', function(Blueprint $table){
            $table->id();
            $table->string('title')->nullable();
            $table->text('image')->nullable();
            $table->text('link')->nullable();
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('banner2s');
    }
}
