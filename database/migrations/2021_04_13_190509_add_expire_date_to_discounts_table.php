<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExpireDateToDiscountsTable extends Migration
{
    public function up()
    {
        Schema::table('discounts', function (Blueprint $table) {
            $table->date('expire_date')->after('value');
        });
    }


    public function down()
    {
        Schema::table('discounts', function (Blueprint $table) {
            //
        });
    }
}
