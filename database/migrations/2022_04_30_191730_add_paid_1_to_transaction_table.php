<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaid1ToTransactionTable extends Migration {

    public function up() {
        Schema::table('transactions', function(Blueprint $table) {
            if (!Schema::hasColumn('transactions', 'paid')) {
                $table->boolean('paid')->default(false);
            }
        });
    }

    public function down() {
        Schema::table('transactions', function(Blueprint $table) {
            //
        });
    }
}
