function prueba(){

    Swal.fire({
        title: 'Selecciona una opción',
        showCancelButton: true,
        confirmButtonText: 'Empleado',
        cancelButtonText: 'Actualizar',
        showDenyButton: true,
        denyButtonText: 'Cliente',
        focusDeny: true,
        buttonsStyling: false, // Desactiva el estilo predeterminado de los botones
        customClass: {
          confirmButton: 'swal-button-color-amarillo', // Clase CSS para el botón de empleado
          cancelButton: 'swal-button-color-azul', // Clase CSS para el botón de actualizar
          denyButton: 'swal-button-color-verde', // Clase CSS para el botón de cliente
        },
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire('Seleccionaste Empleado');
        } else if (result.isDenied) {
          Swal.fire('Seleccionaste Cliente');
        } else {
          Swal.fire('Seleccionaste Actualizar');
        }
      });
      
      
}