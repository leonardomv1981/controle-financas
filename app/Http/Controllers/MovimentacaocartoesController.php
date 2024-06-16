<?php

namespace App\Http\Controllers;

use App\Models\Movimentacaocartoes;
use App\Models\Bancos;
use App\Models\Cartoes;
use App\Models\Categoriagastos;
use App\Models\Componentes;
use App\Models\Parcelascartao;
use Illuminate\Http\Request;

use function Psy\debug;

class MovimentacaocartoesController extends Controller
{
    public function __construct(Movimentacaocartoes $movimentacaoCartoes)
    {
        $this->movimentacaoCartoes = $movimentacaoCartoes;
    }

    public function index(Request $request) {
    
        $mesReferencia = $request->mes_referencia;
        $findMovimentacaoCartoes = $this->movimentacaoCartoes->getMovimentacaoCartao(search: $mesReferencia);
        
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
            $data['categorias'] = Categoriagastos::orderBy('descricao')->get();
            return view('pages.movimentacaocartoes.cadastrar', compact('data'));
        }

        $data = $request->data['movimentacaoCartoes'];

        $fatura_atual = Cartoes::where('id', $data['id_cartao'])->get('fatura_atual');
        $fatura_atual = date('Y-m-01', strtotime($fatura_atual[0]->fatura_atual));

        $movimentacaoCartoes = new Movimentacaocartoes();
        $movimentacaoCartoes->id_cartao = $data['id_cartao'];
        $movimentacaoCartoes->id_categoria = $data['id_categoria'];
        $movimentacaoCartoes->data = $data['data'];
        $movimentacaoCartoes->valor = Componentes::formatInputCurrency($data['valor']) / $data['parcelas'];
        $movimentacaoCartoes->mes_referencia = $fatura_atual;
        $movimentacaoCartoes->descricao = $data['descricao'];
        $movimentacaoCartoes->parcelas = $data['parcelas'];
        $movimentacaoCartoes->parcelado = "nao";
        if ($data['parcelas'] > 1) {
            $movimentacaoCartoes->parcelado = "sim";
            $movimentacaoCartoes->descricao = $data['descricao'] . " - parcela 1/" . $data['parcelas'];
            $movimentacaoCartoes->save();
            for ($i = 1; $i < $data['parcelas']; $i++) {
                $movimentacaoCartoes = new Movimentacaocartoes();
                $movimentacaoCartoes->id_cartao = $data['id_cartao'];
                $movimentacaoCartoes->id_categoria = $data['id_categoria'];
                $movimentacaoCartoes->data = $data['data'];
                $movimentacaoCartoes->valor = Componentes::formatInputCurrency($data['valor']) / $data['parcelas'];
                $movimentacaoCartoes->mes_referencia = date('Y-m-01', strtotime($fatura_atual . '+' . $i . ' months'));
                $movimentacaoCartoes->descricao = $data['descricao'] . " - parcela " . $i + 1 . "/" . $data['parcelas'];
                $movimentacaoCartoes->parcelas = $data['parcelas'];
                $movimentacaoCartoes->save();
            }
        } else {
            $movimentacaoCartoes->save();
        };
        
        return redirect()->route('movimentacaocartoes.listar');
    }

    public function fecharFatura(Request $request) {
        
        $data = $request->all();

        $findMovimentacao = $this->movimentacaoCartoes->where('id', $data['id'])->get();
        $mesReferencia = $findMovimentacao[0]->mes_referencia;
        $id_cartao = $findMovimentacao[0]->id_cartao;

        $cartao = Cartoes::find($id_cartao);
        $cartao->fatura_atual = date('Y-m-01', strtotime($mesReferencia . '+1 month'));
        $cartao->save();

        $findMovimentacoesPosteriores = $this->movimentacaoCartoes
            ->where('situacao', 'ativo')
            ->where('id_cartao', $id_cartao)
            ->where('mes_referencia', '=', $mesReferencia)
            ->where('id', '>', $data['id'])
            ->where('parcelado', 'nao')
            ->get(['id', 'mes_referencia']);

        foreach ($findMovimentacoesPosteriores as $movimentacaoPosterior) {
            $movimentacao = Movimentacaocartoes::find($movimentacaoPosterior->id);
            $movimentacao->mes_referencia = date('Y-m-01', strtotime($movimentacaoPosterior->mes_referencia . '+1 month'));
            $movimentacao->save();
        }

        $totalValor = $this->movimentacaoCartoes
            ->where('situacao', 'ativo')
            ->where('id_cartao', $id_cartao)
            ->where('mes_referencia', $mesReferencia)
            ->sum('valor');

        $categorias = Categoriagastos::orderBy('descricao')->get();

        return view('pages.movimentacaocartoes.fechar', compact('totalValor', 'mesReferencia', 'cartao', 'categorias'));

    }
}
