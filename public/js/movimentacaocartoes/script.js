function fecharFatura (data) {
    var myModal = new bootstrap.Modal(document.getElementById('modal'), {
        keyboard: true
    })
    
    $.ajax({
        url: data.route,
        method: 'post',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
        data: {
            id: data.id_objeto
        },
        dataType: '',
    }).done(function (response) {
        console.log(response);
        $(".modal-body").html(response);
        myModal.show()
    })
    
    
}