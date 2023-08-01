<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItems1ToCartsTable extends Migration{

    public function up(){
        Schema::table('carts', function(Blueprint $table){
            $table->integer('buy_type')->after('send_type');
            $table->unsignedBigInteger('installment_id')->nullable()->after('buy_type');
        });
    }

    public function down(){
        Schema::table('carts', function(Blueprint $table){
            //
        });
    }
}
