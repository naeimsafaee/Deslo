<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClientIdToInstallmentInfosTable extends Migration{

    public function up(){
        Schema::table('installment_infos', function(Blueprint $table){
            $table->unsignedBigInteger('client_id');
        });
    }

    public function down(){
        Schema::table('installment_infos', function(Blueprint $table){
            //
        });
    }
}
