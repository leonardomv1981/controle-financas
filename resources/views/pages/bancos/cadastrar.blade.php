@extends('index')

@section('content')
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <div class="row border-bottom">
        <div class="col-7">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h2">Adicionar banco</h1>
            </div>
        </div>
        <div class="col-5">
            <div class="d-flex justify-content-end grid gap-3">
                <div class="p-2 g-col-6">
                    <a type="button" href="{{ route('bancos.listar') }}" class="btn btn-primary btn-sm">Voltar</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <form class="row g-3" method="POST" action="{{ route('bancos.cadastrar')}}">
            <input type="hidden" name="data[bancos][situacao]" value="ativo">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <label for="nome_banco" class="form-label">Nome do banco</label>
                    <input type="text" name="data[bancos][nome]" class="form-control" id="nome_banco">
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
    
    
@endsection

