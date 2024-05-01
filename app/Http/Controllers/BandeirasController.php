<?php

namespace App\Http\Controllers;

use App\Models\Bandeiras;
use Illuminate\Http\Request;

class BandeirasController extends Controller
{

    public function __construct(Bandeiras $bandeira)
    {
        $this->bandeiras = $bandeira;
    }

    public function index () {
        $findBandeiras = Bandeiras::all();

        return view('pages.bandeiras.listar', compact('findBandeiras'));
    }

    public function delete (Request $request) {
        $bandeira = Bandeiras::find($request->id);
        $bandeira->delete();

        return response()->json(['success' => true]);
    }

    public function cadastrar (Request $request) {
        if ($request->isMethod('get')) {
            return view('pages.bandeiras.cadastrar');
        }

        $data = $request->data['bandeiras'];
        $bandeira = new Bandeiras();
        $bandeira->nome = $data['nome'];
        $bandeira->situacao = $data['situacao'];
        $bandeira->save();

        return redirect()->route('bandeiras.listar');
    }
}
