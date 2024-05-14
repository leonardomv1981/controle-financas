<?php

namespace App\Http\Controllers;

use App\Models\Movimentacaocartoes;
use App\Models\Bancos;
use App\Models\Cartoes;
use App\Models\Categoriagastos;
use App\Models\Parcelascartao;
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
            $data['categorias'] = Categoriagastos::all();
            return view('pages.movimentacaocartoes.cadastrar', compact('data'));
        }

        $data = $request->data['movimentacaoCartoes'];
        $movimentacaoCartoes = new Movimentacaocartoes();
        $movimentacaoCartoes->id_cartao = $data['id_cartao'];
        $movimentacaoCartoes->id_categoria = $data['id_categoria'];
        $movimentacaoCartoes->data = $data['data'];
        $movimentacaoCartoes->valor = str_replace(',', '.', $data['valor']);
        $movimentacaoCartoes->mes_referencia = $data['data'];
        $movimentacaoCartoes->descricao = $data['descricao'];
        if ($data['parcelas'] > 1) {
            $movimentacaoCartoes->parcelado = "sim";
            ParcelascartaoController::cadastrar($data);
        } else {
            $movimentacaoCartoes->parcelado = "nao";
        };
        $movimentacaoCartoes->parcelas = $data['parcelas'];
        $movimentacaoCartoes->save();

        return redirect()->route('movimentacaocartoes.listar');
    }
}
