<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTxIdToTransactionsTable extends Migration{

    public function up(){
        Schema::table('transactions', function(Blueprint $table){
            $table->string('tx_id')->nullable();
        });
    }

    public function down(){
        Schema::table('transactions', function(Blueprint $table){
            //
        });
    }
}
