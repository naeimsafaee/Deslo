<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItemsToProductsTable extends Migration{

    public function up(){
        Schema::table('products', function(Blueprint $table){
            $table->float('rate')->default(0.0);
            $table->integer('stock')->default(0);
            $table->integer('views')->default(0);
        });
    }


    public function down(){
        Schema::table('products', function(Blueprint $table){
            //
        });
    }
}
