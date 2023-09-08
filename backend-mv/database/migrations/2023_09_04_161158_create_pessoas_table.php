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

        //Pessoas:
        // - Id PK Auto Incremment Not Null
        // - Nome VarChar 255 Not Null
        // - CPF VarChar 255 Not Null
        // - DataNascimento DATE
        // - Email VarChar 255 Not Null
        // - TpPessoa Char 1 Not Null
        // - NvHierarquia INT 11

        Schema::create('pessoas', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 255);
            $table->string('cpf', 255)->unique();
            $table->date('dataNascimento')->nullable();
            $table->string('email', 255);
            $table->char('tpPessoa', 1);
            $table->integer('nvHierarquia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pessoas');
    }
};
