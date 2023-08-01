<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiscountToCartTable extends Migration{

    public function up(){
        Schema::table('carts', function(Blueprint $table){
            $table->unsignedBigInteger('discount_id')->default(0)->after('ip');

        });
    }

    public function down(){
        Schema::table('cart', function(Blueprint $table){
            //
        });
    }
}
