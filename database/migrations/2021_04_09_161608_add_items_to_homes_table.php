<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItemsToHomesTable extends Migration{

    public function up(){
        Schema::table('homes', function(Blueprint $table){
            $table->unsignedBigInteger('artist_id')->nullable()->after('sub_category_id');
            $table->integer('count')->default(0)->after('artist_id');
        });
    }

    public function down(){
        Schema::table('homes', function(Blueprint $table){
            //
        });
    }
}
