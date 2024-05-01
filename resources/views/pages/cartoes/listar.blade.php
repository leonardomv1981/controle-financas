@extends('index')

@section('content')

    <meta name="csrf_token" content="{{ csrf_token() }}">
    <div class="row border-bottom">
        <div class="col-7">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h2">Cartões</h1>
            </div>
        </div>
        <div class="col-5">
            <div class="d-flex justify-content-end grid gap-3">
                <div class="p-2 g-col-6">
                    <a type="button" href="{{ route('cartoes.cadastrar') }}" class="btn btn-primary btn-sm">Incluir cartão</a>
                </div>
            </div>
        </div>
    </div>


    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>

                    <th>Nome</th>
                    <th>Banco</th>
                    <th>Bandeira</th>
                    <th>Dia do vencimento</th>
                    <th>Situacao</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($findCartoes as $cartao)
                    <tr>
                        <td>{{ $cartao->nome }}</td>
                        <td>{{ $cartao->nome_banco }}</td>
                        <td>{{ $cartao->nome_bandeira }}</td>
                        <td>{{ $cartao->dia_vencimento }}</td>
                        <td>{{ $cartao->situacao }}</td>
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
@endsection


