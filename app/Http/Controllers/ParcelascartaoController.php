<?php

namespace App\Http\Controllers;

use App\Models\Parcelascartao;
use Illuminate\Http\Request;

class ParcelascartaoController extends Controller
{
    public function __construct(Parcelascartao $parcelas)
    {
        $this->parcelasCartao = $parcelas;
    }

    public function cadastrar($data) {
        echo "teste";
    }
}
