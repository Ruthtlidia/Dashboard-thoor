function importarArquivo(){
    event.preventDefault();



    var file_data = $('#arquivo').prop('files')[0];

    var form_data = new FormData();

    form_data.append('arquivo', file_data);

    Swal.fire({
        title: 'Aguarde que estamos importando seu arquivo...',
        willOpen: () => {
            Swal.showLoading()
          },
      })


    jQuery.ajax({
        url: "xml",
        type: "POST",
        data: form_data,
        processData: false,
        contentType: false,
        success: function( data )
        {
            if(data.situacao == 'success'){
                console.log(data.result);
                $('#frmImportar input').val("");
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: data.msg,
                        showConfirmButton: false,
                        timer: 1500
                    })
            }
            if(data.situacao == 'errorCnpj'){
                $('#errorCnpj').show();
                $('#errorCnpj').fadeOut(6000);
            }
            if(data.situacao == 'errorUsuario'){
                $('#errorUsuario').show();
                $('#errorUsuario').fadeOut(6000);
            }
        }
    });
}




function filtrar(){
    event.preventDefault();

    //console.log($('#frmFiltrar').serialize());

    jQuery.ajax({
        url: "filtrar_graficos",
        type: "POST",
        data: $('#frmFiltrar').serialize(),
        success: function( data )
        {
            if(data.situacao == 'success'){
                console.log(data.motorista);
                location.reload();
                // $('#frmImportar input').val("");
                //     Swal.fire({
                //         position: 'top-end',
                //         icon: 'success',
                //         title: data.msg,
                //         showConfirmButton: false,
                //         timer: 1500
                //     })
            }
            if(data.situacao == 'warning'){
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...  Nenhum resultado foi encontrado nesse período de tempo!',
                  })
            }
            if(data.situacao == 'errorUsuario'){
                $('#errorUsuario').show();
                $('#errorUsuario').fadeOut(6000);
            }
        }
    });
}
