<?php

namespace App\Http\Controllers;

use App\Models\Contas;
use App\Models\Contasrecorrentes;
use App\Models\Categoriagastos;
use App\Models\Componentes;
use Illuminate\Http\Request;

class ContasController extends Controller
{
    public function __construct(Contas $contas)
    {
        $this->contas = $contas;
    }

    public function index(Request $request)
    {
        $mesReferencia = $request->mes_referencia;
        $findMovimentacaoContas = $this->contas->getMovimentacaoContas(search: $mesReferencia);

        return view('pages.contas.listar', compact('findMovimentacaoContas'));
    }

    public function cadastrar (Request $request) {

            if ($request->isMethod('get')) {
                $data['categorias'] = Categoriagastos::orderBy('descricao')->get();
                return view('pages.contas.cadastrar', compact('data'));
            }
    
            $data = $request->data['contas'];

            $conta = new Contas();
            $conta->id_categoria = $data['id_categoria'];
            $conta->data = $data['data'];
            $conta->valor = Componentes::formatInputCurrency($data['valor']);
            $conta->descricao = $data['descricao'];
            $conta->pago = 'nao';
            if (isset($data['pago'])) {
                $conta->pago = 'sim';
            }
            $conta->situacao = $data['situacao'];

            if (isset($data['recorrente'])) {
                $conta->tipo = 'recorrente';
                $conta->save();
                for ($i = 1; $i <= 30; $i++) {
                    $contaRecorrente = new Contas();
                    $contaRecorrente->data = date('Y-m-d', strtotime($data['data'] . ' + ' . $i . ' month'));
                    $contaRecorrente->id_categoria = $data['id_categoria'];
                    $contaRecorrente->id_conta_pai = $conta->id;
                    $contaRecorrente->tipo = 'recorrente';
                    $contaRecorrente->valor = Componentes::formatInputCurrency($data['valor']);
                    $contaRecorrente->descricao = $data['descricao'];
                    $contaRecorrente->pago = 'nao';
                    $contaRecorrente->situacao = 'ativo';
                    $contaRecorrente->save();
                }
            } else {
                $conta->tipo = 'eventual';
                $conta->save();
            }

            return redirect()->route('contas.listar');    
        }

    public function delete(Request $request)
    {
        $conta = Contas::find($request->id);
        $conta->delete();

        return response()->json(['success' => true]);
    }

    public function pagar(Request $request)
    {
        $data = $request->all();
        $conta = Contas::find($request->id);
        if ($data['posicao'] == 'nao') {
            $conta->pago = 'sim';
        } else {
            $conta->pago = 'nao';   
        }
        $conta->save();

        return response()->json(['success' => true]);
    }
}
