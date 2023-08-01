<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->boolean('is_haghighi')->after('id')->nullable();
            $table->string('birthdate')->after('phone')->nullable();
            $table->string('melli_code')->after('birthdate')->nullable();
            $table->boolean('is_foreign')->after('melli_code')->nullable();
            $table->string('landline_phone')->after('is_foreign')->nullable();
            $table->string('email')->after('landline_phone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            //
        });
    }
}
