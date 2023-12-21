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
        Schema::create('atleta_x_campeonato', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('campeonato_id')->unsigned();
            // $table->integer('categoria_id')->unsigned();
            $table->integer('atleta_id')->unsigned();
            $table->integer('cupom_id')->unsigned()->nullable();
           
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

            $table->foreign('campeonato_id')->references('id')->on('campeonatos')->onDelete('no action')->onUpdate('no action');
            // $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('no action')->onUpdate('no action');
            $table->foreign('cupom_id')->references('id')->on('cupons')->onDelete('no action')->onUpdate('no action');
            $table->foreign('atleta_id')->references('id')->on('atletas')->onDelete('no action')->onUpdate('no action');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atleta_x_campeonato');
    }
};
