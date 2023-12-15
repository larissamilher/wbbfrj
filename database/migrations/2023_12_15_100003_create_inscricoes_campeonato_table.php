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
        Schema::create('inscricoes_campeonato', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('campeonato_id')->unsigned();
            $table->integer('categoria_id')->unsigned();
            $table->integer('cupom_id')->unsigned()->nullable();

            $table->string('status');

            $table->string('nome');
            $table->string('cpf');
            $table->string('rg')->nullable();
            $table->date('data_nascimento')->nullable();
            $table->string('celular')->nullable();
            $table->string('email')->nullable();

            $table->string('status_pagamento')->nullable();

            $table->string('cep')->nullable();
            $table->string('estado')->nullable();
            $table->string('cidade')->nullable();
            $table->string('bairro')->nullable();
            $table->string('endereco')->nullable();

            $table->timestamps();
            $table->softDeletes();  

            $table->foreign('campeonato_id')->references('id')->on('campeonatos')->onDelete('no action')->onUpdate('no action');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('no action')->onUpdate('no action');
            $table->foreign('cupom_id')->references('id')->on('cupons')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscricoes_campeonato');
    }
};
