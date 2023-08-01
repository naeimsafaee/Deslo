<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItems1ToProductsTable extends Migration{

    public function up(){
        Schema::table('products', function(Blueprint $table){
            $table->text('file')->nullable()->after('description');
            $table->string('file_name')->nullable()->after('file');
        });
    }


    public function down(){
        Schema::table('products', function(Blueprint $table){
            //
        });
    }
}
