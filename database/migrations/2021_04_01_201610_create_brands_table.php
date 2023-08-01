<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration{

    public function up(){
        Schema::create('brands', function(Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('en_name');
            $table->text('image')->nullable();
            $table->boolean('show_in_home')->default(false);
            $table->timestamps();
        });
    }


    public function down(){
        Schema::dropIfExists('brands');
    }
}
