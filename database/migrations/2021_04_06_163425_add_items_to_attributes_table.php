<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItemsToAttributesTable extends Migration
{

    public function up()
    {
        Schema::table('attributes', function (Blueprint $table) {

            $table->unsignedBigInteger('group_attribute_id')->after('text');
        });
    }


    public function down()
    {
        Schema::table('attributes', function (Blueprint $table) {
            //
        });
    }
}
