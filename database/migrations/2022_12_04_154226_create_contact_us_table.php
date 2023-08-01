<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactUsTable extends Migration {

    public function up() {
        Schema::create('contact_us', function(Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->text('description');
            $table->boolean('is_pending')->default(true);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('contact_us');
    }
}
