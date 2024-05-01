@extends('index')

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
                        <th>Parcelado?</th>
                        <th>Parcelas</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($findMovimentacaoCartoes as $movimentacao)
                        <tr>
                            <td>{{ $movimentacao->nome_cartao }}</td>
                            <td>{{ $movimentacao->data }}</td>
                            <td>{{ $movimentacao->descricao }}</td>
                            <td>{{ $movimentacao->parcelado }}</td>
                            <td>{{ $movimentacao->parcelas }}</td>
                            <td>
                                <a href="" class="btn btn-outline-primary btn-sm">
                                    Editar
                                </a>
                                <button onclick="deleteRegistro('{{ route('cartoes.delete') }}', {{ $cartao->id }})" class="btn btn-outline-danger btn-sm">
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


