<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientToMemberShipsTable extends Migration{

    public function up(){
        Schema::create('client_to_member_ships', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('membership_id');
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('membership_id')->references('id')->on('memberships')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    public function down(){
        Schema::dropIfExists('client_to_member_ships');
    }
}
