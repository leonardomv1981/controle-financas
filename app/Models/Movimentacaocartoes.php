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
        if ($search) {
            $movimentacaoCartao = $this->join('cartoes', 'movimentacaocartoes.id_cartao', '=', 'cartoes.id')->
        join('categoriagastos', 'movimentacaocartoes.id_categoria', '=', 'categoriagastos.id')->get(['movimentacaocartoes.*', 'cartoes.nome as nome_cartao', 'categoriagastos.descricao as categoria_gasto'])->where('mes_referencia', "$search-01");
        } else {
            $mes_referencia = date('Y-m-01');
            $movimentacaoCartao = $this->join('cartoes', 'movimentacaocartoes.id_cartao', '=', 'cartoes.id')->
        join('categoriagastos', 'movimentacaocartoes.id_categoria', '=', 'categoriagastos.id')->get(['movimentacaocartoes.*', 'cartoes.nome as nome_cartao', 'categoriagastos.descricao as categoria_gasto'])->where('mes_referencia', $mes_referencia);
        }

        $movimentacaoCartao = $movimentacaoCartao->groupBy('id_cartao')->toArray();

        return $movimentacaoCartao;
    }
}
