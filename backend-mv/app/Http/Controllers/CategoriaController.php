<?php
namespace App\Http\Controllers;
use App\Models\Categorias as ModelsCategoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoria = ModelsCategoria::all();
        return response()->json($categoria);
    }

    /**
     * Incluir Categrorias
     */
    public function incluir(Request $request)
    {
        $novaCategoria = $request->all();
        
        foreach ($novaCategoria as $categoria) {
            $bancoSalva = new ModelsCategoria();
            $bancoSalva->categoria =  $categoria;
            $bancoSalva->save();
        }

        return response()->json(['message' => 'Salvo com sucesso!']);
    }

    /**
     * Exclui item
     */
    public function excluir(string $id)
    {
        $item = ModelsCategoria::find($id);
        $item->delete();

        return response()->json(['message' => 'Item excluído com sucesso!']);
    }
}
