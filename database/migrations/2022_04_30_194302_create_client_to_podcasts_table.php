<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientToPodcastsTable extends Migration
{

    public function up()
    {
        Schema::create('client_to_podcasts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('podcast_id');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('client_to_podcasts');
    }
}
