<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContasrecorrentesController extends Controller
{
    public function __construct (Contasrecorrentes $contasrecorrentes)
    {
        $this->contasrecorrentes = $contasrecorrentes;
    }
}
