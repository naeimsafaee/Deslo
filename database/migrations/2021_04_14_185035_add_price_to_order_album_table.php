<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceToOrderAlbumTable extends Migration
{
    public function up()
    {
        Schema::table('order_albums', function (Blueprint $table) {
            $table->text('price')->after('album_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('order_album', function (Blueprint $table) {
            //
        });
    }
}
