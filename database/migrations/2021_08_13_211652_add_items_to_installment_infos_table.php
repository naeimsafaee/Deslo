<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItemsToInstallmentInfosTable extends Migration{

    public function up(){
        Schema::table('installment_infos', function(Blueprint $table){
            $table->boolean('status')->default(false);
        });
    }

    public function down(){
        Schema::table('installment_infos', function(Blueprint $table){
            //
        });
    }
}
