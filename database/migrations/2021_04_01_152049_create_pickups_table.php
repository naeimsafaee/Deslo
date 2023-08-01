<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePickupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pickups', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('phone');
            $table->text('model');
            $table->string('date');
            $table->text('serial');
            $table->text('type');
            $table->unsignedBigInteger('town_id');
            $table->unsignedBigInteger('city_id');
            $table->text('address');
            $table->integer('floors');
            $table->unsignedBigInteger('client_id');
            $table->timestamps();
            $table->foreign('client_id')->references('id')->on('clients')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pickups');
    }
}
