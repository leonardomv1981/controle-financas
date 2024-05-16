<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartoes extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'id_banco',
        'id_bandeira',
        'dia_vencimento',
        'fatura_atual',
        'situacao'
    ];

    public function getCartoesCadastrados(string $search = NULL)
    {
        // $cartoes = $this->where(function ($query) use ($search) {
        //     if (!empty($search)) {
        //         $query->whereRaw('id_banco = ?', $search);
        //         // $query->orWhere('nome_banco', 'LIKE', "%{$search}%");
        //     };
        // })->join('bancos', 'cartoes.id_banco', '=', 'bancos.id')->orderBy('cartoes.nome')->join('bandeiras', 'cartoes.id_bandeira', '=', 'bandeiras.id')->get();

        $cartoes = $this->join('bandeiras', 'cartoes.id_bandeira', '=', 'bandeiras.id')->join('bancos', 'cartoes.id_banco', '=', 'bancos.id')->get(['cartoes.*', 'bandeiras.nome as nome_bandeira', 'bancos.nome as nome_banco']);

        return $cartoes;
    }

    // public function banco()
    // {
    //     return $this->belongsTo(Bancos::class, 'id_banco');
    // }

    // public function bandeira()
    // {
    //     return $this->belongsTo(Bandeiras::class, 'id_bandeira');
    // }
}
