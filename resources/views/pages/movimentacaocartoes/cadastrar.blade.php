@extends('index')
@section('content')
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <div class="row border-bottom">
        <div class="col-7">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h2">Adicionar cartão</h1>
            </div>
        </div>
        <div class="col-5">
            <div class="d-flex justify-content-end grid gap-3">
                <div class="p-2 g-col-6">
                    <a type="button" href="{{ route('movimentacaocartoes.listar') }}" class="btn btn-primary btn-sm">Voltar</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <form class="row g-3" method="POST" action="{{ route('movimentacaocartoes.cadastrar')}}">
            <input type="hidden" name="data[movimentacaoCartoes][situacao]" value="ativo">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <label for="nome_cartao" class="form-label">Nome do cartão</label>
                    <input type="text" name="data[movimentacaoCartoes][nome]" class="form-control" id="nome_cartao">
                </div>
                <div class="col-md-4">
                    <label for="cartão" class="form-label">Cartão</label>
                    <select name="data[movimentacaoCartoes][id_cartao]" class="form-select" id="banco">
                        <option selected>Selecione...</option>
                        @foreach ($data['cartoes'] as $cartao)
                            <option value="{{ $cartao->id }}">{{ $cartao->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="dia_vencimento" class="form-label">Dia do vencimento</label>
                    <select name="data[movimentacaoCartoes][dia_vencimento]" class="form-select" id="dia_vencimento">
                        <option selected>Selecione...</option>
                        @for ($i = 1; $i <= 31; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
    
    
@endsection


