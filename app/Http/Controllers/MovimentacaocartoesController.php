<?php

namespace App\Http\Controllers;

use App\Models\Movimentacaocartoes;
use App\Models\Bancos;
use App\Models\Cartoes;
use Illuminate\Http\Request;

class MovimentacaocartoesController extends Controller
{
    public function __construct(Movimentacaocartoes $movimentacaoCartoes)
    {
        $this->movimentacaoCartoes = $movimentacaoCartoes;
    }

    public function index() {
        
        $findMovimentacaoCartoes = $this->movimentacaoCartoes->getMovimentacaoCartao();
        
        return view('pages.movimentacaocartoes.listar', compact('findMovimentacaoCartoes'));
    }

    public function delete (Request $request) {
        $movimentacaoCartoes = Movimentacaocartoes::find($request->id);
        $movimentacaoCartoes->delete();

        return response()->json(['success' => true]);
    }

    

    public function cadastrar (Request $request) {
        if ($request->isMethod('get')) {
            $data['cartoes'] = Cartoes::all();
            return view('pages.movimentacaocartoes.cadastrar', compact('data'));
        }

        dd($request);

        $data = $request->data['movimentacaocartao'];
        $movimentacaoCartoes = new Movimentacaocartoes();
        $movimentacaoCartoes->id_cartao = $data['id_cartao'];
        $movimentacaoCartoes->data = $data['data'];
        $movimentacaoCartoes->valor = $data['valor'];
        $movimentacaoCartoes->tipo = $data['tipo'];
        $movimentacaoCartoes->save();

        return redirect()->route('movimentacaocartoes.listar');
    }
}
