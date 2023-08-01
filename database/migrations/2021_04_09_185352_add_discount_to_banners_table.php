<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiscountToBannersTable extends Migration{

    public function up(){
        Schema::table('banners', function(Blueprint $table){
            $table->integer('discount')->nullable()->after('price_1');
        });
    }

    public function down(){
        Schema::table('banners', function(Blueprint $table){
            //
        });
    }
}
