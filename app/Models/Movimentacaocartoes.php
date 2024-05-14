<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimentacaocartoes extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_cartao',
        'data',
        'valor',
        'descricao',
        'parcelado',
        'parcelas',
        'mes_referencia',
        'situacao'
    ];

    public function getMovimentacaoCartao(string $search = NULL)
    {
        $movimentacaoCartao = $this->join('cartoes', 'movimentacaocartoes.id_cartao', '=', 'cartoes.id')->
        join('categoriagastos', 'movimentacaocartoes.id_categoria', '=', 'categoriagastos.id')->get(['movimentacaocartoes.*', 'cartoes.nome as nome_cartao', 'categoriagastos.descricao as categoria_gasto']);

        return $movimentacaoCartao;
    }
}
