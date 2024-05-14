<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcelascartao extends Model
{
    use HasFactory;

    protected $filliable = [
        'id_cartao',
        'data_inicial',
        'data_final',
        'valor',
        'quantidade_parcelas',
        'situacao'
    ];




}
