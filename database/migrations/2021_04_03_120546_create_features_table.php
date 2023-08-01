<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeaturesTable extends Migration{

    public function up(){
        Schema::create('features', function(Blueprint $table){
            $table->id();
            $table->text('text');
            $table->boolean('is_positive')->default(true);
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('features');
    }
}
