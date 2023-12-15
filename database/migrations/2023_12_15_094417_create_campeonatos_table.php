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
        Schema::create('campeonatos', function (Blueprint $table) {
            $table->increments('id');
            $table->text('nome');
            $table->date('data_inicio_inscricao');
            $table->date('data_final_inscricao');
            $table->date('data_campeonato');
            $table->float('valor');

            $table->text('local')->nullable();
            $table->text('descricao')->nullable();

            $table->timestamps();
            $table->softDeletes();  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campeonatos');
    }
};
