<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_payment', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedInteger('patient_id');
            $table->unsignedBigInteger('service_id');
             $table->boolean('status')->default(1);
            $table->text('description')->nullable();
            $table->string('payable_amount');
            $table->string('appointment_unique_id');
            $table->integer('payment_type')->default('1');
            $table->integer('payment_method')->default('1');

        
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade')->onUpdate('cascade');
         

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services_payment');
    }
}
