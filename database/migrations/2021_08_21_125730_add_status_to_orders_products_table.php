<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToOrdersProductsTable extends Migration
{
    public function up()
    {
        Schema::table('orders_products', function (Blueprint $table) {
            $table->tinyInteger('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders_products', function (Blueprint $table) {
            //
        });
    }
}
