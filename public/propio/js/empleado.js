function buscar(url){
    var carnet = document.getElementById("txtCarnet").value;
    var op=0;
    if(carnet==null||carnet==''||isNaN(carnet)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El carnet es obligatorio y solo debe contener numeros',
        })
        op=1;
    }

    var token = $('meta[name="csrf-token"]').attr('content');
    var buscar =
    "carnet="+carnet
    +"&_token="+token;

    
    if(op==0){
        $.ajax({
            url: url,
            type: 'POST',
            data: buscar,
        })
        .done(function(respuesta){
            if(respuesta=='mal'){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'El usuario que busca no esta registrado' ,
                })
            }else{
                document.getElementById("txtId").innerHTML=respuesta.id;
                $("#txtNombres").val(respuesta.name);
                $("#txtApellidos").val(respuesta.paterno+" "+respuesta.materno);
            }
        });
    }

}


function guardar(url,actual,siguiente){
    var carnet = document.getElementById("txtCarnet").value;
    var id = document.getElementById("txtId").innerHTML;
    var cargo = document.getElementById("txtCargo").value;
    var op=0;

    if(carnet==null||carnet==''||isNaN(carnet)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El carnet es obligatorio y solo debe contener numeros',
        })
        op=1;
    }

    var token = $('meta[name="csrf-token"]').attr('content');
    var guardar =
    "id="+id
    +"&carnet="+carnet
    +"&cargo="+cargo
    +"&_token="+token;

    
    if(op==0){
        $.ajax({
            url: url,
            type: 'POST',
            data: guardar,
        })
        .done(function(respuesta){
            if(respuesta=='ok'){
                Swal.fire({
                    title: 'Selecciona una opción',
                    showCancelButton: true,
                    confirmButtonText: 'Siguiente',
                    cancelButtonText: 'Actualizar',
                    buttonsStyling: false, // Desactiva el estilo predeterminado de los botones
                    customClass: {
                      confirmButton: 'swal-button-color-amarillo', // Clase CSS para el botón de empleado
                      cancelButton: 'swal-button-color-azul', // Clase CSS para el botón de actualizar
                    },
                  }).then((result) => {
                    if (result.isConfirmed) {
                      Swal.fire('Seleccionaste Siguiente');
                      setTimeout(function(){
                        location.href=siguiente;
                      },2500); 
                    }else {
                      Swal.fire('Seleccionaste Actualizar');
                      setTimeout(function(){
                        location.href=actual;
                      },2500); 
                    }
                });
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'El usuario ya cuenta con un cargo' ,
                })
            }
        });
    }

}


function desactivar(url,url2){

    Swal.fire({
        title: 'Estas seguro de desactivar el registro?',
        showDenyButton: true,
        confirmButtonText: 'Aceptar',
        denyButtonText: `Cancelar`,
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: 'GET',
            })
            .done(function(respuesta){
                
                if(respuesta=='ok'){
                    setTimeout(function(){
                        location.href=url2;
                    },2500);     
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Surgio un error:' + respuesta,
                    })
                }
                
            });  
          Swal.fire('Desactivado', '', 'success')
        } else if (result.isDenied) {
          Swal.fire('Cancelado', '', 'info')
        }
      })
    
       
}

function activar(url,url2){

    Swal.fire({
        title: 'Estas seguro de activar el registro?',
        showDenyButton: true,
        confirmButtonText: 'Aceptar',
        denyButtonText: `Cancelar`,
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: 'GET',
            })
            .done(function(respuesta){
                
                if(respuesta=='ok'){
                    setTimeout(function(){
                        location.href=url2;
                    },2500);     
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Surgio un error:' + respuesta,
                    })
                }
                
            });  
          Swal.fire('Activado', '', 'success')
        } else if (result.isDenied) {
          Swal.fire('Cancelado', '', 'info')
        }
      })
    
       
}