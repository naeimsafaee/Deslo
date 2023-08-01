<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallmentsTable extends Migration{

    public function up(){
        Schema::create('installments', function(Blueprint $table){
            $table->id();
            $table->integer('darsad')->default(0);
            $table->integer('number_of_month');
            $table->timestamps();
        });
    }


    public function down(){
        Schema::dropIfExists('installments');
    }
}
