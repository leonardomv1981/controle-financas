<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contasrecorrentes extends Model
{
    use HasFactory;

    protected $fillable = [
        'dia_vencimento',
        'id_categoria',
        'valor',
        'descricao',
        'ultimo_pagamento',
        'situacao'
    ];

    public static function getContasRecorrentes(string $search = NULL)
    {
        if ($search) {
            $contasRecorrentes = self::join('categoriagastos', 'contasrecorrentes.id_categoria', '=', 'categoriagastos.id')
                ->get(['contasrecorrentes.*', 'categoriagastos.descricao as categoria_gasto'])
                ->where('situacao', 'ativo')
                ->where('dia_vencimento', date('d', strtotime($search)));
        } else {
            $contasRecorrentes = self::join('categoriagastos', 'contasrecorrentes.id_categoria', '=', 'categoriagastos.id')
                ->get(['contasrecorrentes.*', 'categoriagastos.descricao as categoria_gasto'])
                ->where('situacao', 'ativo');
        }

        return $contasRecorrentes;
    }
}
