<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionMemberShipsTable extends Migration{

    public function up(){
        Schema::create('transaction_member_ships', function(Blueprint $table){
            $table->id();
            $table->unsignedInteger('transaction_id');
            $table->unsignedInteger('membership_id');
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('transaction_member_ships');
    }
}
