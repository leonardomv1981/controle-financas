<?php

namespace App\Http\Controllers;

use App\Models\Categoriagastos;
use Illuminate\Http\Request;

class CategoriagastosController extends Controller
{
    
    public function __construct(Categoriagastos $categoriaGasto)
    {
        $this->categoriaGasto = $categoriaGasto;
    }

    public function index () {
        $findCategorias = $this->categoriaGasto->getCategoriasCadastradas();

        return view('pages.categoria-gastos.listar', compact('findCategorias'));
    }

    public function cadastrar (Request $request) {
        if ($request->isMethod('get')) {
            return view('pages.categoria-gastos.cadastrar');
        }

        $data = $request->data['categoriaGastos'];

        $categoria = new Categoriagastos();
        $categoria->descricao = $data['descricao'];
        $categoria->situacao = $data['situacao'];
        $categoria->save();

        return redirect()->route('categoria-gastos.listar');
    }

    public function delete(Request $request)
    {
        $categoria = Categoriagastos::find($request->id);
        $categoria->delete();

        return response()->json(['success' => true]);
    }
}
