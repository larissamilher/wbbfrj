<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('filiados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('atleta_id')->unsigned();
            $table->string('codigo')->nullable();           

            $table->string('status')->nullable();
            $table->string('status_pagamento')->nullable();

            $table->date('validade_filiacao')->nullable();
            $table->longText('selfie')->nullable();
            $table->string('payment_id')->nullable();           
            $table->string('customer')->nullable();     
            $table->string('billingType')->nullable();
            $table->float('value')->nullable();
            $table->date('dueDate')->nullable();
            $table->string('installmentCount')->nullable();
            $table->float('totalValue')->nullable();
            $table->string('remoteIp')->nullable();
            $table->string('holderName')->nullable();
            $table->string('creditCardNumber')->nullable();
            $table->string('creditCardBrand')->nullable();
            $table->string('creditCardToken')->nullable();

            $table->timestamps();
            $table->softDeletes();  

            $table->foreign('atleta_id')->references('id')->on('atletas')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filiados');
    }
};
