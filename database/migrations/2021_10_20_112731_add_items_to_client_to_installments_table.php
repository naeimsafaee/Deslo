<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItemsToClientToInstallmentsTable extends Migration{

    public function up(){
        Schema::table('client_to_installments', function(Blueprint $table){
            $table->unsignedBigInteger('transaction_id')->nullable();
        });
    }

    public function down(){
        Schema::table('client_to_installments', function(Blueprint $table){
            //
        });
    }
}
