@extends('index')


    <script src="{{ asset('js/contas/script.js') }}"></script>


@section('content')
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <div class="row border-bottom">
        <div class="col-7">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h2">Contas do mês</h1>
            </div>
        </div>
        <div class="col-5">
            <div class="d-flex justify-content-end grid gap-3">
                <div class="p-2 g-col-6">
                    <a type="button" href="{{ route('contas.cadastrar') }}" class="btn btn-primary btn-sm">Incluir conta</a>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        Despesas fixas
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Vencimento</th>
                    <th>Categoria</th>
                    <th>Descricao</th>
                    <th>Valor</th>
                    <th>Subtotal</th>
                    <th>Pago?</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $subTotal = 0;
                @endphp
                @foreach ($findContasRecorrentes as $contaRecorrente)
                    <tr>
                        <td>{{ $contaRecorrente->dia_vencimento }}</td>
                        <td>{{ $contaRecorrente->categoria_gasto }}</td>
                        <td>{{ $contaRecorrente->descricao }}</td>
                        <td>R$ {{ str_replace('.', ',', $contaRecorrente->valor) }}</td>
                        <td>R$ {{ str_replace('.', ',', $subTotal += $contaRecorrente->valor) }}</td>
                        <td>
                            @php
                                $mesAtual = date('m');
                                if ($contaRecorrente->ultimo_pagamento != null)
                                {
                                    $ultimoPagamento = date('m', strtotime($contaRecorrente->ultimo_pagamento));
                                } else {
                                    $ultimoPagamento = 0;
                                }
                            @endphp
                            <input type="checkbox" name="data[contas][pago]" class="btn-check btn-sm" id="btncheck{{$contaRecorrente->id}}" autocomplete="off" {{ $ultimoPagamento == $mesAtual ? 'checked' : '' }} onclick="changePay('{{ route('contas-recorrentes.pagar') }}', {{ $contaRecorrente->id }}, '{{ $ultimoPagamento == $mesAtual ? 'sim' : 'nao' }}')" >
                            <label class="btn btn-sm btn-outline-primary" for="btncheck{{$contaRecorrente->id}}">Pago</label>
                        </td>
                        <td>
                            <a href="" class="btn btn-outline-primary btn-sm">
                                Editar
                            </a>
                            <button onclick="deleteRegistro('{{ route('contas-recorrentes.delete') }}', {{ $contaRecorrente->id }})" class="btn btn-outline-danger btn-sm">
                                Excluir
                            </button>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3">Total</td>
                    <td>R$ {{ str_replace('.', ',', $subTotal) }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="table-responsive">
        Despesas eventuais
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Categoria</th>
                    <th>Descricao</th>
                    <th>Valor</th>
                    <th>Subtotal</th>
                    <th>Pago?</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $subTotal = 0;
                @endphp
                @foreach ($findMovimentacaoContas as $conta)
                    <tr>
                        <td>{{ date('d/m/Y', strtotime($conta->data)) }}</td>
                        <td>{{ $conta->categoria_gasto }}</td>
                        <td>{{ $conta->descricao }}</td>
                        <td>R$ {{ str_replace('.', ',', $conta->valor) }}</td>
                        <td>R$ {{ str_replace('.', ',', $subTotal += $conta->valor) }}</td>
                        <td>
                            <input type="checkbox" name="data[contas][pago]" class="btn-check btn-sm" id="btncheck{{$conta->id}}" autocomplete="off" {{ $conta->pago == 'sim' ? 'checked' : '' }} onclick="changePay('{{ route('contas.pagar') }}', {{ $conta->id }}, '{{ $conta->pago }}')" >
                            <label class="btn btn-sm btn-outline-primary" for="btncheck{{$conta->id}}">Pago</label>
                        </td>
                        <td>
                            <a href="" class="btn btn-outline-primary btn-sm">
                                Editar
                            </a>
                            <button onclick="deleteRegistro('{{ route('contas.delete') }}', {{ $conta->id }})" class="btn btn-outline-danger btn-sm">
                                Excluir
                            </button>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3">Total</td>
                    <td>R$ {{ str_replace('.', ',', $subTotal) }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection




