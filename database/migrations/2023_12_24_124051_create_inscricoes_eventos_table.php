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
        Schema::create('inscricoes_eventos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('evento_id')->unsigned();

            $table->string('nome');
            $table->string('cpf');
            $table->string('rg')->nullable();
            $table->date('data_nascimento')->nullable();
            $table->string('celular')->nullable();
            $table->string('email')->nullable();
            $table->string('cep')->nullable();
            $table->string('estado')->nullable();
            $table->string('cidade')->nullable();
            $table->string('logradouro')->nullable();
            $table->string('bairro')->nullable();
            $table->string('numero')->nullable();

            $table->string('status_pagamento')->nullable();
            $table->string('payment_id');           
            $table->string('customer');     
            $table->string('billingType');
            $table->float('value');
            $table->date('dueDate');
            $table->string('installmentCount')->nullable();
            $table->float('totalValue')->nullable();
            $table->string('remoteIp')->nullable();
            $table->string('holderName')->nullable();
            $table->string('creditCardNumber')->nullable();
            $table->string('creditCardBrand')->nullable();
            $table->string('creditCardToken')->nullable();

            $table->timestamps();
            $table->softDeletes();  

            $table->foreign('evento_id')->references('id')->on('eventos')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscricoes_eventos');
    }
};
