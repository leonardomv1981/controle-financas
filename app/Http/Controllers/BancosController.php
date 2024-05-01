<?php

namespace App\Http\Controllers;

use App\Models\Bancos;
use Illuminate\Http\Request;

class BancosController extends Controller
{

    public function __construct(Bancos $banco)
    {
        $this->bancos = $banco;
    }

    public function index () {
        $findBancos = Bancos::all();

        return view('pages.bancos.listar', compact('findBancos'));

    }

    public function delete (Request $request) {
        $banco = Bancos::find($request->id);
        $banco->delete();

        return response()->json(['success' => true]);
    }

    public function cadastrar (Request $request) {
        if ($request->isMethod('get')) {
            return view('pages.bancos.cadastrar');
        }

        $data = $request->data['bancos'];

        $banco = new Bancos();
        $banco->nome = $data['nome'];
        $banco->situacao = $data['situacao'];
        $banco->save();

        return redirect()->route('bancos.listar');
        

        
    }
}
