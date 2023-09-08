<?php

namespace App\Http\Controllers;

use App\Models\Veiculos as ModelsVeiculo;

use Illuminate\Http\Request;

class VeiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $veiculo = ModelsVeiculo::all();
        return response()->json($veiculo);
    }

    public function incluir(Request $request)
    {
        // Precisaria fazer bastante coisa ainda, validar os dados que estou recebendo.
        // Mas o tempo está contra mim...
        $novoVeiculo = new ModelsVeiculo();

        $novoVeiculo->categoria_id  = $request->input('categoriaID');
        $novoVeiculo->placa         = $request->input('placa');
        $novoVeiculo->marca         = $request->input('marca');
        $novoVeiculo->modelo        = $request->input('modelo');
        $novoVeiculo->descricao     = $request->input('descricao');
        $novoVeiculo->anexo         = 'G';
        $novoVeiculo->custo_aluguel = $request->input('custoAluguel');

        try {
            $novoVeiculo->save();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['message' => 'Salvo com sucesso!']);
    }

    public function uploadImagem(Request $request) {
        $uploadedImages = [];

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();

                // Mover o arquivo para a pasta de destino (por exemplo, "public/uploads")
                $file->storeAs('uploads', $fileName, 'public');

                // Armazenar a URL completa da imagem para renderização
                $url = asset('storage/uploads/' . $fileName);
                $uploadedImages[] = $url;
            }
        }
    }

     /**
     * Incluir informação no cadastro de veículo.
     */
    public function editar(Request $request, $id)
    {
        // Precisaria fazer bastante coisa ainda, validar os dados que estou recebendo.
        // Mas o tempo está contra mim...
        $editaVeiculo = ModelsVeiculo::findOrFail($id);

        $editaVeiculo->categoria_id  = $request->input('categoriaID');
        $editaVeiculo->placa         = $request->input('placa');
        $editaVeiculo->marca         = $request->input('marca');
        $editaVeiculo->modelo        = $request->input('modelo');
        $editaVeiculo->descricao     = $request->input('descricao');
        $editaVeiculo->anexo         = 'G';
        $editaVeiculo->custo_aluguel = $request->input('custoAluguel');

        try {
            $editaVeiculo->save();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['message' => 'Editado com sucesso!']);
    }

    /**
    * Exclui item
    */
    public function excluir(string $id)
    {
        $item = ModelsVeiculo::find($id);
        $item->delete();

        return response()->json(['message' => 'Cadastro excluído com sucesso!']);
    }

    public function trazVeiculo(string $id)
    {
        $veiculo = ModelsVeiculo::find($id);
        return response()->json($veiculo);
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
