<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcelascartao extends Model
{
    use HasFactory;

    protected $filliable = [
        'id_cartao',
        'id_movimentacao',
        'data_compra',
        'valor_total',
        'quantidade_parcelas',
        'situacao'
    ];

    public function cadastrar($data) {
        dd($data);
    }




}
