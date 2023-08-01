<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientToAlbumsTable extends Migration{

    public function up(){
        Schema::create('client_to_albums', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('album_id');
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    public function down(){
        Schema::dropIfExists('client_to_albums');
    }
}
