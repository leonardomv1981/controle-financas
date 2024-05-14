@extends('index')
@section('content')
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <div class="row border-bottom">
        <div class="col-7">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h2">Adicionar movimentação</h1>
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
                    <label for="cartão" class="form-label">Cartão</label>
                    <select name="data[movimentacaoCartoes][id_cartao]" class="form-select" id="cartao">
                        <option selected>Selecione...</option>
                        @foreach ($data['cartoes'] as $cartao)
                            <option value="{{ $cartao->id }}">{{ $cartao->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="categoria" class="form-label">Categoria</label>
                    <select name="data[movimentacaoCartoes][id_categoria]" class="form-select" id="categoria">
                        <option selected>Selecione...</option>
                        @foreach ($data['categorias'] as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->descricao }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="data" class="form-label">Data</label>
                    <input type="date" name="data[movimentacaoCartoes][data]" class="form-control" id="data">
                </div>
                <div class="col-md-4">
                    <label for="valor" class="form-label">Valor</label>
                    <input type="text" name="data[movimentacaoCartoes][valor]" class="form-control" id="valor">
                </div>
                <div class="col-md-4">
                    <label for="descricao" class="form-label">Descrição</label>
                    <input type="text" name="data[movimentacaoCartoes][descricao]" class="form-control" id="descricao">
                </div>
                <div class="col-md-4">
                    <label for="parcelas" class="form-label">Parcelas</label>
                    <select name="data[movimentacaoCartoes][parcelas]" class="form-select" id="parcelas">
                        <option value="1" selected>Única</option>
                        @for ($i = 2; $i <= 12; $i++)
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

    <script> 
        $('#valor').maskMoney({
             prefix: "R$: ",
             decimal: ",",
             thousands: "."
         });
    </script>
    
    
@endsection


