@extends('index')

@section('content')

    <meta name="csrf_token" content="{{ csrf_token() }}">
    <div class="row border-bottom">
        <div class="col-7">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h2">Configurações</h1>
            </div>
        </div>
    </div>
    <div class="row row-cols-4">
        <div class="card col">
            <div class="card-body">
                <a class="nav-link d-flex align-items-center gap-2" href="{{ route('bancos.listar') }}">
                    <svg class="bi"><use xlink:href="#icone-mais"/></svg>
                    Bancos
                </a>
            </div>
        </div>
        <div class="card col">
            <div class="card-body">
                <a class="nav-link d-flex align-items-center gap-2" href="{{ route('cartoes.listar') }}">
                    <svg class="bi"><use xlink:href="#icone-mais"/></svg>
                    Cartões
                </a>
            </div>
        </div>
        <div class="card col">
            <div class="card-body">
                <a class="nav-link d-flex align-items-center gap-2" href="{{ route('bandeiras.listar') }}">
                    <svg class="bi"><use xlink:href="#icone-mais"/></svg>
                    Bandeiras
                </a>
            </div>
        </div>
        <div class="card col">
            <div class="card-body">
                <a class="nav-link d-flex align-items-center gap-2" href="{{ route('bandeiras.listar') }}">
                    <svg class="bi"><use xlink:href="#icone-mais"/></svg>
                    Categoria de gastos
                </a>
            </div>
        </div>
        <div class="card col">
            <div class="card-body">
                This is some text within a card body.
            </div>
        </div>
    </div>
@endsection

