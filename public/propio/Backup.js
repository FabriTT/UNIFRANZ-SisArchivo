
function backup(ruta) {

    Swal.fire({
        title: 'Cargando...',
        allowOutsideClick: false,
        showConfirmButton: false,
        onBeforeOpen: () => {
            Swal.showLoading();
        }
    });

    $.ajax({
        type: 'GET',
        url: ruta,
        processData: false,
        contentType: false,
        success: function (response) {
            Swal.close();

            if (response === 'ok') {
                Swal.fire({
                    title: 'Respaldo exitoso!',
                    text: 'Guardado en el escritorio',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            } else {
                Swal.fire({
                    title: '¡Error!',
                    text: 'Error al guardar en la base de datos' + response,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        }

    });

}

