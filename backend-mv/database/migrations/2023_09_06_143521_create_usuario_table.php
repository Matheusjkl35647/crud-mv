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
        // Usuarios: 
        // - Id PK Auto Incremment Not Null
        // - Tipo Char (1) - 'F' ou Padrao('C')
        // - Nome VarChar 255 Not Null
        // - Email VarCgar 255 Not Null
        // - Senha VarChar 255 Not Null
        // - PessoaID Int 11 Chave estrangeira

        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->char('tipo', 1)->default('C');
            $table->string('nome', 255);
            $table->string('email', 255)->unique();
            $table->string('senha', 255);
            $table->unsignedBigInteger('pessoa_id');
            $table->foreign('pessoa_id')->references('id')->on('pessoas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
