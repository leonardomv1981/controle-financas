<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoriagastos extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao',
        'situacao'
    ];

    public function getCategoriasCadastradas() 
    {
        $categorias = Categoriagastos::orderBy('descricao', 'asc')->get();

        return $categorias;
    }
}
