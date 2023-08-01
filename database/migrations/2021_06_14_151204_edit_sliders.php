<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditSliders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->dropColumn('main_image');
            $table->dropColumn('title');
            $table->dropColumn('brand');
            $table->dropColumn('price');
            $table->dropColumn('discount_price');
            $table->dropColumn('video_link');
            $table->dropColumn('video_image');
            $table->dropColumn('video_title');
            $table->dropColumn('discount');
            $table->string('link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sliders', function (Blueprint $table) {
            //
        });
    }
}
