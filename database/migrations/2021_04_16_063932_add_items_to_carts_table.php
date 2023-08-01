<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItemsToCartsTable extends Migration{

    public function up(){
        Schema::table('carts', function(Blueprint $table){
            $table->unsignedBigInteger('address_id')->after('discount_id')->nullable();
            $table->integer('send_type')->after('address_id')->default(1);
        });
    }

    public function down(){
        Schema::table('carts', function(Blueprint $table){
            //
        });
    }
}
