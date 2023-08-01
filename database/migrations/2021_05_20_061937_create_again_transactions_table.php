<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgainTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->double('amount');
            $table->unsignedInteger('client_id');
            $table->timestamp('transaction_date')->default(\Carbon\Carbon::now());
            $table->tinyInteger('status')->default(0);
            $table->string('token')->nullable();
            $table->string('bank_transaction_id')->nullable();
            $table->string('bank_card_number')->nullable();
            $table->string('bank_message')->nullable();
            $table->tinyInteger('type')->default(0);
            $table->unsignedInteger('discount_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
