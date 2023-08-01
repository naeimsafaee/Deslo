<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallmentInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installment_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('transaction_id');
            $table->string('national_code')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('birthdate')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->string('shenasname_code')->nullable();
            $table->string('email')->nullable();
            $table->tinyInteger('marital_status')->nullable();
            $table->tinyInteger('purchase_type')->nullable();
            $table->tinyInteger('bank')->nullable();
            $table->string('shomare_hesab_jari')->nullable();
            $table->string('shenase_sayad')->nullable();
            $table->string('shomare_hesab')->nullable();
            $table->string('purchase_amount_approx')->nullable();
            $table->string('bank_account_create_date')->nullable();
            $table->tinyInteger('daste_check_type')->nullable();
            $table->string('shobe_name_and_code')->nullable();
            $table->text('description')->nullable();
            $table->string('job')->nullable();
            $table->string('company_name')->nullable();
            $table->string('monthly_income')->nullable();
            $table->tinyInteger('employment_status')->nullable();
            $table->text('company_address')->nullable();
            $table->string('company_phone')->nullable();
            $table->unsignedInteger('town_id')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->text('home_address')->nullable();
            $table->string('home_phone')->nullable();
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
        Schema::dropIfExists('installment_infos');
    }
}
