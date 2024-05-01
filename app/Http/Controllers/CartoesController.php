<?php

namespace App\Http\Controllers;

use App\Models\Bancos;
use App\Models\Bandeiras;
use App\Models\Cartoes;
use Illuminate\Http\Request;

class CartoesController extends Controller
{

    public function __construct(Cartoes $cartao)
    {
        $this->cartoes = $cartao;
    }

    public function index () {
        $findCartoes = $this->cartoes->getCartoesCadastrados();

        return view('pages.cartoes.listar', compact('findCartoes'));
    }

    public function delete (Request $request) {
        $cartao = Cartoes::find($request->id);
        $cartao->delete();

        return response()->json(['success' => true]);
    }

    public function cadastrar (Request $request) {
        if ($request->isMethod('get')) {
            $data['bancos'] = Bancos::all();
            $data['bandeiras'] = Bandeiras::all();
            return view('pages.cartoes.cadastrar', compact('data'));
        }

        $data = $request->data['cartoes'];
        $cartao = new Cartoes();
        $cartao->nome = $data['nome'];
        $cartao->id_banco = $data['id_banco'];
        $cartao->id_bandeira = $data['id_bandeira'];
        $cartao->dia_vencimento = $data['dia_vencimento'];
        $cartao->situacao = $data['situacao'];
        $cartao->save();

        return redirect()->route('cartoes.listar');
    }
}
