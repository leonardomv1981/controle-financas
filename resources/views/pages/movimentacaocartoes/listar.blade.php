@extends('index')

<script src="{{ asset('js/movimentacaocartoes/script.js') }}"></script>

@section('content')

    <meta name="csrf_token" content="{{ csrf_token() }}">
    <div class="row border-bottom">
        <div class="col-7">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h2">Movimentação de cartões</h1>
            </div>
        </div>
        <div class="col-5">
            <div class="d-flex justify-content-end grid gap-3">
                <div class="p-2 g-col-6">
                    <a type="button" href="{{ route('movimentacaocartoes.cadastrar') }}" class="btn btn-primary btn-sm">Incluir movimentação</a>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('movimentacaocartoes.listar') }}" method="get">
        Pesquisar: <input type="month" name="mes_referencia" value="{{ request('mes_referencia', date('Y-m')) }}" onchange="this.form.submit()">
    </form>
    

    @if($findMovimentacaoCartoes->isEmpty())
        <div class="alert alert-warning" role="alert">
            Nenhuma movimentação de cartão cadastrada.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Data</th>
                        <th>descrição</th>
                        <th>Parcelas</th>
                        <th>Tipo de gasto</th>
                        <th>Fatura</th>
                        <th>valor</th>
                        <th>Subtotal</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $subtotal = 0;
                    @endphp
                    @foreach ($findMovimentacaoCartoes as $movimentacao)
                        <tr>
                            <td>{{ $movimentacao->nome_cartao }}</td>
                            <td>{{ date('d/m/Y', strtotime($movimentacao->data)) }}</td>
                            <td>{{ $movimentacao->descricao }}</td>
                            <td>{{ $movimentacao->parcelas }}</td>
                            <td>{{ $movimentacao->categoria_gasto }}</td>
                            <td>{{ date('m/Y', strtotime($movimentacao->mes_referencia)) }}</td>
                            <td>R$ {{ $movimentacao->valor }}</td>
                            <td>R$ {{ $subtotal += $movimentacao->valor }}</td>
                            <td>
                                <button class="btn btn-outline-primary btn-sm" onclick="fecharFatura({'route': '{{ route('movimentacaocartoes.fechar-fatura') }}', 'id_objeto': '{{ $movimentacao->id }}'})">
                                    Fechar fatura
                                </button>
                                <a href="" class="btn btn-outline-primary btn-sm">
                                    Editar
                                </a>
                                <button onclick="deleteRegistro('{{ route('movimentacaocartoes.delete') }}', {{ $movimentacao->id }})" class="btn btn-outline-danger btn-sm">
                                    Excluir
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection


