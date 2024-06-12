<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class componentes extends Model
{
    use HasFactory;

    public static function formatInputCurrency($valor)
    {
        $valorRetorno = str_replace(['R$', ':', ' ', '.'], '', $valor);
        $valorRetorno = str_replace(',', '.', $valorRetorno);

        return $valorRetorno;
    }
}
