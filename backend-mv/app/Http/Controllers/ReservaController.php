<?php

namespace App\Http\Controllers;
use App\Models\Reservas as ModelsReserva;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservas  = ModelsReserva::select('reservas.reserva_ativa', 'reservas.id', 'veiculos.marca', 'reservas.data_reserva_de', 'reservas.data_reserva_ate', 'pessoas.nome',)
                                ->leftJoin('pessoas', 'pessoas.id', '=', 'reservas.pessoa_id')
                                ->leftJoin('veiculos', 'veiculos.id', '=', 'reservas.veiculo_id')
                                ->get();

        foreach ($reservas as $reserva) {
            $reserva->data_reserva_de = Carbon::createFromFormat('Y-m-d', $reserva->data_reserva_de)->format('d/m/Y');
            $reserva->data_reserva_ate = Carbon::createFromFormat('Y-m-d', $reserva->data_reserva_ate)->format('d/m/Y');
        }
                                
        return response()->json($reservas);
    }

    public function incluir(Request $request)
    {
        // Precisaria fazer bastante coisa ainda, validar os dados que estou recebendo.
        // Mas o tempo está contra mim...
        $novnovaReserva = new ModelsReserva();

        $novnovaReserva->pessoa_id          = $request->input('nomeID');
        $novnovaReserva->reserva_ativa      = 1;
        $novnovaReserva->veiculo_id         = $request->input('veiculoID');
        $novnovaReserva->data_reserva_de    = $request->input('dataDe');
        $novnovaReserva->data_reserva_ate   = $request->input('dataAte');

        try {
            $novnovaReserva->save();
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

        return response()->json(['message' => 'Salvo com sucesso!']);
    }

    public function cancelar(Request $request, $id)
    {

        $cancelaReserva = ModelsReserva::findOrFail($id);

        $cancelaReserva->reserva_ativa = 0;

        try {
            $cancelaReserva->save();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['message' => 'Reserva cancelada com sucesso!']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
