function changePay(rotaUrl, id_objeto, posicao) {
    $.ajax({
        url: rotaUrl,
        method: 'post',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
        data: {
            id: id_objeto,
            posicao: posicao
        },
        dataType: '',
        beforeSend: function () {
            $.blockUI({
                message: 'Aguarde...',
                timeout: 2000,
            })
        },
    }).done(function (data) {
        if (data.success == true) {
            window.location.reload(); 
        } else {
            alert('houve um erro')
        };
    }).fail(function(data){
        $.unblockUI();
        alert('não foi possível buscar os dados');
    })
}