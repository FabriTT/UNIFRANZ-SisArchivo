function seleccionar(datos){
    dato=datos.split('||');
    document.getElementById("ModtxtId").innerHTML=dato[0];
    $("#ModtxtNombres").val(dato[1]);
    $("#ModtxtPaterno").val(dato[2]);
    $("#ModtxtMaterno").val(dato[3]);
    $("#ModtxtCarnet").val(dato[4]);
    $("#ModtxtNacimiento").val(dato[5]);
    $("#ModtxtTelefono").val(dato[6]);
    $("#ModtxtCorreo").val(dato[7]);
    document.getElementById("NombreImg").innerHTML=dato[8];
}


function guardar(url,act,emp,cli){
    var nombres = document.getElementById("txtNombres").value;
    var paterno = document.getElementById("txtPaterno").value;
    var materno = document.getElementById("txtMaterno").value;
    var correo = document.getElementById("txtCorreo").value;
    var contraseña= document.getElementById("txtContraseña").value;
    var confirmar= document.getElementById("txtConfirmar").value;
    var carnet = document.getElementById("txtCarnet").value;
    var nacimiento = document.getElementById("txtNacimiento").value;
    var telefono = document.getElementById("txtTelefono").value;
    var imagen = document.getElementById("txtImagen").files[0].name;
    

    var regExp1 = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g;
    var regExp2 = /[a-zA-Z]+/;

    


    var token = $('meta[name="csrf-token"]').attr('content');
    var guardar =
    "nombres="+nombres
    +"&paterno="+paterno
    +"&materno="+materno
    +"&correo="+correo
    +"&contraseña="+contraseña
    +"&carnet="+carnet
    +"&nacimiento="+nacimiento
    +"&telefono="+telefono
    +"&imagen="+imagen
    +"&_token="+token;

 
    var op=0;

    if(nombres==null||nombres==''||!regExp2.test(nombres)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El nombre es obligatorio y no debe contener numeros',
        })
        op=1;
    }
    if(paterno==null||paterno==''||!regExp2.test(paterno)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El apellido paterno es obligatorio y no debe contener numeros',
        })
        op=1;
    }
    if(materno==null||materno==''||!regExp2.test(materno)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El apellido materno es obligatorio y no debe contener numeros',
        })
        op=1;
    }
    if(correo==null||correo==''||!regExp1.test(correo)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El correo es obligatorio y debe estar en el formato correcto',
        })
        op=1;
    }
    if(contraseña==null||contraseña==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La contraseña es obligatoria',
        })
        
        op=1;
    }

    if(contraseña!==confirmar){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'Las contraseñas no coinciden',
        })
        
        op=1;
    }    

    if(carnet==null||carnet==''||isNaN(carnet)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El carnet es obligatorio y solo debe contener numeros',
        })
        op=1;
    }
    if(nacimiento==null||nacimiento==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La fecha de nacimiento es obligatoria',
        })
        op=1;
    }
    if(telefono==null||telefono==''||isNaN(telefono)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El telefono es obligatorio y solo debe contener numeros',
        })
        op=1;
    }

    if(imagen==null||imagen==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La imagen es obligaotira',
        })
        op=1;
    }




    

    if(op==0){
        $.ajax({
            url: url,
            type: 'POST',
            data: guardar,
        })
        .done(function(respuesta){
            console.log(respuesta)
            
            if(respuesta=='ok'){
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
                      setTimeout(function(){
                        location.href=emp;
                      },2500); 
                    } else if (result.isDenied) {
                      Swal.fire('Seleccionaste Cliente');
                      setTimeout(function(){
                        location.href=cli;
                      },2500); 
                    } else {
                      Swal.fire('Seleccionaste Actualizar');
                      setTimeout(function(){
                        location.href=act;
                      },2500); 
                    }
                });
                  
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error:' + respuesta,
                })
            }
            
        });
    }


}



function editar(url,url2){
    var id = document.getElementById("ModtxtId").innerHTML;
    var nombres = document.getElementById("ModtxtNombres").value;
    var paterno = document.getElementById("ModtxtPaterno").value;
    var materno = document.getElementById("ModtxtMaterno").value;
    var correo = document.getElementById("ModtxtCorreo").value;
    var carnet = document.getElementById("ModtxtCarnet").value;
    var nacimiento = document.getElementById("ModtxtNacimiento").value;
    var telefono = document.getElementById("ModtxtTelefono").value;
    try {
        var imagen = document.getElementById("ModtxtImagen").files[0].name;
    } catch (error) {
        var imagen = document.getElementById("NombreImg").innerHTML;
    }


 

    var regExp1 = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g;
    var regExp2 = /[a-zA-Z]+/;

    var op=0;

    if(nombres==null||nombres==''||!regExp2.test(nombres)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El nombre es obligatorio y no debe contener numeros',
        })
        op=1;
    }
    if(paterno==null||paterno==''||!regExp2.test(paterno)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El apellido paterno es obligatorio y no debe contener numeros',
        })
        op=1;
    }
    if(materno==null||materno==''||!regExp2.test(materno)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El apellido materno es obligatorio y no debe contener numeros',
        })
        op=1;
    }
    if(correo==null||correo==''||!regExp1.test(correo)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El correo es obligatorio y debe estar en el formato correcto',
        })
        op=1;
    }  

    if(carnet==null||carnet==''||isNaN(carnet)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El carnet es obligatorio y solo debe contener numeros',
        })
        op=1;
    }
    if(nacimiento==null||nacimiento==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La fecha de nacimiento es obligaotira',
        })
        op=1;
    }
    if(telefono==null||telefono==''||isNaN(telefono)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El telefono es obligatorio y solo debe contener numeros',
        })
        op=1;
    }

 

    var token = $('meta[name="csrf-token"]').attr('content');
    var editar =
    "id="+id
    +"&nombres="+nombres
    +"&paterno="+paterno
    +"&materno="+materno
    +"&correo="+correo
    +"&carnet="+carnet
    +"&nacimiento="+nacimiento
    +"&telefono="+telefono
    +"&imagen="+imagen
    +"&_token="+token;

    if(op==0){
        $.ajax({
            url: url,
            type: 'POST',
            data: editar,
        })
        .done(function(respuesta){
            
            if(respuesta=='ok'){
                Swal.fire({
                    icon: 'success',
                    title: 'Correcto',
                    text: 'Se edito exitosamente',
                })
                setTimeout(function(){
                    location.href=url2;
                },2500);    
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error:' + respuesta,
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


