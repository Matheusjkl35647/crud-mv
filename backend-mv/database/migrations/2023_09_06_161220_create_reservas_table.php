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

        
        // Reservas: 

        // - Id PK Auto Incremment Not Null
        // - ClienteID
        // - VeiculoID
        // - DataReservaDe Date Not Null
        // - DataReservaAte Date Not Null
        // - ReservaAtiva Char 1 '1' -> Ativo ou Padrão '0'-> Cancelado e '2' -> Histoórico


        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pessoa_id');
            $table->unsignedBigInteger('veiculo_id');
            $table->date('data_reserva_de');
            $table->date('data_reserva_ate');
            $table->char('reserva_ativa', 1);
            $table->timestamps();

            $table->foreign('pessoa_id')->references('id')->on('pessoas');
            $table->foreign('veiculo_id')->references('id')->on('veiculos');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
