<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelsTransactionMusicTable extends Migration {

    public function up() {
        Schema::create('transaction_music', function(Blueprint $table) {
            $table->id();
            $table->unsignedInteger('transaction_id');
            $table->unsignedInteger('music_id');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('transaction_music');
    }
}
