<?php

namespace App\Http\Controllers;

use App\Models\Pessoas as ModelPessoa;

use Illuminate\Http\Request;

class PessoaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pessoa = ModelPessoa::all();
        return response()->json($pessoa);
    }

    /**
     * Incluir informação no cadastro de pessoa.
     */
    public function incluir(Request $request)
    {

        // Precisaria fazer bastante coisa ainda, validar os dados que estou recebendo.
        // Mas o tempo está contra mim...
        $novaPessoa = new ModelPessoa();

        $novaPessoa->nome           = $request->input('nome');
        $novaPessoa->cpf            = $request->input('cpf');
        $novaPessoa->dataNascimento = $request->input('dtNascimento');
        $novaPessoa->email          = $request->input('email');
        $novaPessoa->tpPessoa       = $request->input('tpPessoa');
        $novaPessoa->nvHierarquia   = $request->input('nvHierarquia');

        $novaPessoa->save();

        return response()->json(['message' => 'Salvo com sucesso!']);
    }

    /**
     * Incluir informação no cadastro de pessoa.
     */
    public function editar(Request $request, $id)
    {
        // Precisaria fazer bastante coisa ainda, validar os dados que estou recebendo.
        // Mas o tempo está contra mim...
        $editaPessoa = ModelPessoa::findOrFail($id);

        $editaPessoa->nome           = $request->input('nome');
        $editaPessoa->cpf            = $request->input('cpf');
        $editaPessoa->dataNascimento = $request->input('dtNascimento');
        $editaPessoa->email          = $request->input('email');
        $editaPessoa->tpPessoa       = $request->input('tpPessoa');
        $editaPessoa->nvHierarquia   = $request->input('nvHierarquia');

        $editaPessoa->save();

        return response()->json(['message' => 'Editado com sucesso!']);
    }

     /**
     * Exclui item
     */
    public function excluir(string $id)
    {
        $item = ModelPessoa::find($id);
        $item->delete();

        return response()->json(['message' => 'Cadastro excluído com sucesso!']);
    }

    /**
     * Traz Dados Pessoa específica para edição
     */
    public function trazPessoa(string $id)
    {
        $pessoa = ModelPessoa::find($id);
        return response()->json($pessoa);
    }

    /**
     * Traz Dados Pessoa específica para edição
     */
    public function trazPessoaTipo(string $cond)
    {
        
        $pessoa = ModelPessoa::select('pessoas.*')->where('pessoas.tpPessoa', $cond)->where('usuarios.nome', Null)
                             ->leftJoin('usuarios', 'usuarios.pessoa_id', '=', 'pessoas.id')
                             ->get();
        return response()->json($pessoa);
    }

/**
     * Traz Dados Pessoa específica para edição
     */
    public function trazPessoaCliente()
    {
        
        $pessoa = ModelPessoa::where('pessoas.tpPessoa', 'C')->get();
        return response()->json($pessoa);
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
