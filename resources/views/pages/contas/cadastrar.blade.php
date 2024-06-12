@extends('index')
@section('content')
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <div class="row border-bottom">
        <div class="col-7">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h2">Adicionar conta</h1>
            </div>
        </div>
        <div class="col-5">
            <div class="d-flex justify-content-end grid gap-3">
                <div class="p-2 g-col-6">
                    <a type="button" href="{{ route('contas.listar') }}" class="btn btn-primary btn-sm">Voltar</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <form class="row g-3" method="POST" action="{{ route('contas.cadastrar')}}">
            <input type="hidden" name="data[contas][situacao]" value="ativo">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <label for="categoria" class="form-label">Categoria</label>
                    <select name="data[contas][id_categoria]" class="form-select" id="categoria">
                        <option selected>Selecione...</option>
                        @foreach ($data['categorias'] as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->descricao }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="data" class="form-label">Data</label>
                    <input type="date" name="data[contas][data]" class="form-control" id="data" required>
                </div>
                <div class="col-md-4">
                    <label for="valor" class="form-label">Valor</label>
                    <input type="text" name="data[contas][valor]" class="form-control" id="valor" required >
                </div>
                <div class="col-md-4">
                    <label for="descricao" class="form-label">Descrição</label>
                    <input type="text" name="data[contas][descricao]" class="form-control" id="descricao" required>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <input type="checkbox" name="data[contas][pago]" class="btn-check" id="pago" autocomplete="off">
                    <label class="btn btn-outline-primary" for="pago">Pago</label>
                    <input type="checkbox" name="data[contas][recorrente]" class="btn-check" id="recorrente" autocomplete="off">
                    <label class="btn btn-outline-primary" for="recorrente">Recorrente</label>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>

    <script> 
        $(document).ready(function(){
            Inputmask("R$ (.999){+|1},99", {
                positionCaretOnClick: "radixFocus",
                radixPoint: ".",
                _radixDance: true,
                numericInput: true,
                placeholder: "0",
                definitions: {
                    "0": {
                        validator: "[0-9\uFF11-\uFF19]"
                    }
                }
            }).mask('#valor');
        });
    </script>
    
    
@endsection


