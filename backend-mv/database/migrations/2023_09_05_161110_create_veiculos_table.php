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
        // Veiculos: 
        // - Id PK Auto Incremment Not Null
        // - CategoriaID Int 11 Not Null
        // - Placa VarChar 7 Not Null
        // - Marca VarChar 255 Not Null
        // - Modelo VarChar 255 Not Null
        // - Descricao VarChar 255 Not Null
        // - Anexo Varchar 255 Not Null
        // - CustoAluguel Double 10,2 Not Null

        Schema::create('veiculos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categoria_id');
            $table->string('placa', 7);
            $table->string('marca', 255);
            $table->string('modelo', 255);
            $table->string('descricao', 255);
            $table->string('anexo', 255);
            $table->decimal('custo_aluguel', 10, 2);
            $table->timestamps();

            $table->foreign('categoria_id')->references('id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('veiculos');
    }
};
