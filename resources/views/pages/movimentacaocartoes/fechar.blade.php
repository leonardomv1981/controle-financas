@php
$vencimento = date('Y-m-d', strtotime(date('Y-m') . '-' . $cartao->dia_vencimento));
if ($vencimento <= date('Y-m-d')) {
    $vencimento = date('Y-m-d', strtotime('+1 month', strtotime($vencimento)));
}
@endphp
<div class="container">
    <div class="row">
        <div>
            <p></p>Você fechou a fatura do cartão {{ $cartao->nome }} referente ao mês {{ date('m/Y', strtotime($mesReferencia))}} no valor de R$ {{ number_format($totalValor, 2, ',', '.') }}.</p>
        </div>
        
    </div>
    <div class="row">
        <div>
            <b>Caso deseje incluir a fatura com vencimento em {{ date('d/m/Y', strtotime($vencimento)) }} nas contas a pagar, clique abaixo.</b>
        </div>
        </div>        
    </div>
    <div class="row">

        <form class="row g-3" method="POST" action="{{ route('contas.cadastrar')}}">
            <input type="hidden" name="data[contas][situacao]" value="ativo">
            <input type="hidden" name="data[contas][data]" value="{{$vencimento}}">
            <input type="hidden" name="data[contas][descricao]" value="Fatura CC {{ $cartao->nome }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label for="categoria" class="form-label">Categoria</label>
                    <select name="data[contas][id_categoria]" class="form-select" id="categoria">
                        <option selected>Selecione...</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->descricao }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="valor" class="form-label">Valor</label>
                    <input type="text" name="data[contas][valor]" class="form-control" id="valor" required value="{{$totalValor}}">
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
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