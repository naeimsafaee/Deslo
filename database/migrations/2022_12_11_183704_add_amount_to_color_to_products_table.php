<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAmountToColorToProductsTable extends Migration {

    public function up() {
        Schema::table('color_to_products', function(Blueprint $table) {
            $table->string('amount')->default(0);
        });
    }

    public function down() {
        Schema::table('color_to_products', function(Blueprint $table) {
            //
        });
    }
}
