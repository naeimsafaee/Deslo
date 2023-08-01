<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductFeaturesTable extends Migration
{

    public function up()
    {
        Schema::create('product_features', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('feature_id');
            $table->unsignedBigInteger('product_id');
            $table->timestamps();

            $table->foreign('feature_id')->references('id')->on('features')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');

        });
    }


    public function down()
    {
        Schema::dropIfExists('product_features');
    }
}
