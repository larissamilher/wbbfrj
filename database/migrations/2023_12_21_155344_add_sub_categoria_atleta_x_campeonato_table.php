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
        Schema::table('atleta_x_campeonato', function (Blueprint $table) {
            $table->integer('sub_categoria_id')->unsigned()->after('campeonato_id');

            $table->foreign('sub_categoria_id')->references('id')->on('sub_categorias')->onDelete('no action')->onUpdate('no action');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
