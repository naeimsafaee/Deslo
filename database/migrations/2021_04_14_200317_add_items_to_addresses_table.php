<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItemsToAddressesTable extends Migration
{
    public function up()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->string('full_name')->nullable()->after('title');
            $table->string('postal_code')->nullable()->after('full_name');
        });
    }

    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {
            //
        });
    }
}
