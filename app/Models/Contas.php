<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contas extends Model
{
    use HasFactory;

    protected $fillable = [
        'data',
        'id_categoria',
        'valor',
        'descricao',
        'pago',
        'situacao'
    ];

    public function getMovimentacaoContas(string $search = NULL)
    {
        if ($search) {
            $lastDayOfMonth = date('Y-m-t', strtotime($search));
            $movimentacaoContas = $this->join('categoriagastos', 'contas.id_categoria', '=', 'categoriagastos.id')
                ->get(['contas.*', 'categoriagastos.descricao as categoria_gasto'])
                ->whereBetween('data', [$search, $lastDayOfMonth]);
        } else {
            $mes_referencia = date('Y-m-01');
            $movimentacaoContas = $this->join('categoriagastos', 'contas.id_categoria', '=', 'categoriagastos.id')->get(['contas.*', 'categoriagastos.descricao as categoria_gasto'])->where('data', '>=', "%$mes_referencia%");
        }
        

        return $movimentacaoContas;
    }
}
