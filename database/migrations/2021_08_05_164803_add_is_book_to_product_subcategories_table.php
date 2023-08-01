<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsBookToProductSubcategoriesTable extends Migration{

    public function up(){
        Schema::table('product_sub_categories', function(Blueprint $table){
            $table->boolean('is_book')->default(false);
        });
    }


    public function down(){
        Schema::table('product_sub_categories', function(Blueprint $table){
            //
        });
    }
}
