<?php

namespace App\Http\Controllers;

use App\Models\Usuario as ModelsUsuario;
use App\Models\Pessoas as ModelPessoa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuario = ModelsUsuario::select('usuarios.nome as usuario', 'pessoas.*')->leftJoin('pessoas', 'pessoas.id', '=', 'usuarios.pessoa_id')->get();
        return response()->json($usuario);
    }


    /**
     * Verificação Login
     */
    public function login(Request $request)
    {
        $usuario = ModelsUsuario::where('nome', $request->input('nome'))->first();

        if (!$usuario) {
            return response()->json(['message' => 'Usuário não encontrado'], 401);
        }

        if (Hash::check($request->input('senha'), $usuario->senha)) {
           return response()->json([
                'message' => 'Sucesso, aguarde por favor...',
                'pessoa' => ['nome' => $request->input('nome'), 'pessoaID' => $usuario->pessoa_id, 'tpPessoa' => $usuario->tipo]
           ]);
        } else {
            return response()->json(['message' => 'Usuário e/ou senha incorreta!'], 401);
        }        
    }

    public function incluir(Request $request)
    {
        $encontraPessoa = ModelPessoa::find($request->input('nomeID'));

        // Precisaria fazer bastante coisa ainda, validar os dados que estou recebendo.
        // Mas o tempo está contra mim...
        $novoUsuario = new ModelsUsuario();

        $novoUsuario->pessoa_id = $request->input('nomeID');
        $novoUsuario->nome      = $request->input('usuario');
        $novoUsuario->senha     = Hash::make($request->input('senha'));
        $novoUsuario->email     = $encontraPessoa->email;
        $novoUsuario->tipo      = $encontraPessoa->tpPessoa;

        try {
            $novoUsuario->save();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['message' => 'Usuário criado com sucesso']);
    }

    public function trazUsuario(string $id)
    {
        $usuario = ModelsUsuario::select('usuarios.id as id', 'pessoas.id as pessoaID', 'usuarios.nome', 'pessoas.nome as pNome','pessoas.nvHierarquia', 'usuarios.tipo')
                                ->leftJoin('pessoas', 'pessoas.id', '=', 'usuarios.pessoa_id')->where('pessoas.id', $id)->get();

        return response()->json($usuario);
    }

    /**
     * Incluir informação no cadastro de Usuário.
     */
    public function editar(Request $request, $id)
    {
        // Precisaria fazer bastante coisa ainda, validar os dados que estou recebendo.
        // Mas o tempo está contra mim...
        $editaUsuario = ModelsUsuario::findOrFail($id);

        $editaUsuario->nome           = $request->input('usuario');
        $editaUsuario->senha   = Hash::make($request->input('senha'));

        $editaUsuario->save();

        return response()->json(['message' => 'Editado com sucesso!']);
    }

    /**
     * Exclui item
     */
    public function excluir(string $id)
    {
        $item = ModelsUsuario::find($id);
        $item->delete();

        return response()->json(['message' => 'Usuário excluído com sucesso!']);
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
