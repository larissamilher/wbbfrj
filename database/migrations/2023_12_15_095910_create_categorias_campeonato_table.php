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
        Schema::create('categorias_campeonato', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('campeonato_id')->unsigned();
            $table->integer('categoria_id')->unsigned();

            $table->timestamps();
            $table->softDeletes();  

            $table->foreign('campeonato_id')->references('id')->on('campeonatos')->onDelete('no action')->onUpdate('no action');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('no action')->onUpdate('no action');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias_campeonato');
    }
};
