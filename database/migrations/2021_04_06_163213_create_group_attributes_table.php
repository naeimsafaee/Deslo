<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupAttributesTable extends Migration{

    public function up(){
        Schema::create('group_attributes', function(Blueprint $table){
            $table->id();
            $table->text('text');
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('group_attributes');
    }
}
