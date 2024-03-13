function seleccionar(datos){
    dato=datos.split('||');
    document.getElementById("ModtxtId").innerHTML=dato[0];
    $("#ModtxtNombres").val(dato[1]);
    $("#ModtxtPaterno").val(dato[2]);
    $("#ModtxtMaterno").val(dato[3]);
    $("#ModtxtEdad").val(dato[4]);
    $("#ModtxtPartida").val(dato[5]);
    $("#ModtxtProvincia").val(dato[6]);
    document.getElementById("ModtxtDepartamento").text=dato[7];
    document.getElementById("ModtxtDepartamento").value=dato[7];
    $("#ModtxtPais").val(dato[8]);
    $("#ModtxtCausaMuerte").val(dato[9]);
    $("#ModtxtFamiliar").val(dato[10]);
    $("#ModtxtRelacion").val(dato[11]);
    $("#ModtxtNombresDr").val(dato[12]);
    $("#ModtxtPaternoDr").val(dato[13]);
    $("#ModtxtMaternoDr").val(dato[14]);
    $("#ModtxtCarnetDr").val(dato[15]);
    console.log(dato[15]+dato[14]);

}


function guardar(url,actual,siguiente){
    var nombres = document.getElementById("txtNombres").value;
    var paterno = document.getElementById("txtPaterno").value;
    var materno = document.getElementById("txtMaterno").value;
    var edad = document.getElementById("txtEdad").value;
    var partida = document.getElementById("txtPartida").value;
    var provincia = document.getElementById("txtProvincia").value;
    var departamento = document.getElementById("txtDepartamento").value;
    var pais = document.getElementById("txtPais").value;
    var causaMuerte = document.getElementById("txtCausaMuerte").value;
    var familiar = document.getElementById("txtFamiliar").value;
    var relacion = document.getElementById("txtRelacion").value;
    var nombreDr = document.getElementById("txtNombresDr").value;
    var paternoDr = document.getElementById("txtPaternoDr").value;
    var maternoDr = document.getElementById("txtMaternoDr").value;
    var carnetDr = document.getElementById("txtCarnetDr").value;
 

    var regExp1 = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g;
    var regExp2 = /[a-zA-Z]+/;

    


    var token = $('meta[name="csrf-token"]').attr('content');
    var guardar =
    "nombres="+nombres
    +"&paterno="+paterno
    +"&materno="+materno
    +"&edad="+edad
    +"&partida="+partida
    +"&provincia="+provincia
    +"&departamento="+departamento
    +"&pais="+pais
    +"&causaMuerte="+causaMuerte
    +"&familiar="+familiar
    +"&relacion="+relacion
    +"&nombreDr="+nombreDr
    +"&paternoDr="+paternoDr
    +"&maternoDr="+maternoDr
    +"&carnetDr="+carnetDr
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
    if(edad==null||edad==''||isNaN(edad)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La edad es obligatoria y solo debe contener numeros',
        })
        op=1;
    }
    if(partida==null||partida==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La fecha de partida es obligatoria',
        })
        op=1;
    }
    if(provincia==null||provincia==''||!regExp2.test(provincia)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La provincia es obligatoria y no debe contener numeros',
        })
        op=1;
    }
    if(departamento==null||departamento==''||!regExp2.test(departamento)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El departamento es obligatorio y no debe contener numeros',
        })
        op=1;
    }
    if(pais==null||pais==''||!regExp2.test(pais)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El pais es obligatorio y no debe contener numeros',
        })
        op=1;
    }
    if(causaMuerte==null||causaMuerte==''||!regExp2.test(causaMuerte)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La causa de muerte es obligatoria y no debe contener numeros',
        })
        op=1;
    }
    if(familiar==null||familiar==''||isNaN(familiar)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El familiar es obligatorio y solo debe contener numeros',
        })
        op=1;
    }
    if(relacion==null||relacion==''||!regExp2.test(relacion)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La relacion con el familiar es obligatoria y no debe contener numeros',
        })
        op=1;
    }
    if(nombreDr==null||nombreDr==''||!regExp2.test(nombreDr)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El nombre del doctor es obligatorio y no debe contener numeros',
        })
        op=1;
    }
    if(paternoDr==null||paternoDr==''||!regExp2.test(paternoDr)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El apellido paterno del doctor es obligatorio y no debe contener numeros',
        })
        op=1;
    }
    if(maternoDr==null||maternoDr==''||!regExp2.test(maternoDr)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El apellido materno del doctor es obligatorio y no debe contener numeros',
        })
        op=1;
    }
    if(carnetDr==null||carnetDr==''||isNaN(carnetDr)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El carnet del doctor es obligatorio y no debe contener numeros',
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
            }else if(respuesta=='mal'){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'El familiar no se encuentra registrado en el sistema:',
                })
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
    var edad = document.getElementById("ModtxtEdad").value;
    var partida = document.getElementById("ModtxtPartida").value;
    var provincia = document.getElementById("ModtxtProvincia").value;
    var departamento = document.getElementById("ModtxtDepartamento").value;
    var pais = document.getElementById("ModtxtPais").value;
    var causaMuerte = document.getElementById("ModtxtCausaMuerte").value;
    var familiar = document.getElementById("ModtxtFamiliar").value;
    var relacion = document.getElementById("ModtxtRelacion").value;
    var nombreDr = document.getElementById("ModtxtNombresDr").value;
    var paternoDr = document.getElementById("ModtxtPaternoDr").value;
    var maternoDr = document.getElementById("ModtxtMaternoDr").value;
    var carnetDr = document.getElementById("ModtxtCarnetDr").value;
 

    var regExp1 = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g;
    var regExp2 = /[a-zA-Z]+/;

    


    var token = $('meta[name="csrf-token"]').attr('content');
    var editar =
    "id="+id 
    +"&nombres="+nombres
    +"&paterno="+paterno
    +"&materno="+materno
    +"&edad="+edad
    +"&partida="+partida
    +"&provincia="+provincia
    +"&departamento="+departamento
    +"&pais="+pais
    +"&causaMuerte="+causaMuerte
    +"&familiar="+familiar
    +"&relacion="+relacion
    +"&nombreDr="+nombreDr
    +"&paternoDr="+paternoDr
    +"&maternoDr="+maternoDr
    +"&carnetDr="+carnetDr
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
    if(edad==null||edad==''||isNaN(edad)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La edad es obligatoria y solo debe contener numeros',
        })
        op=1;
    }
    if(partida==null||partida==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La fecha de partida es obligatoria',
        })
        op=1;
    }
    if(provincia==null||provincia==''||!regExp2.test(provincia)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La provincia es obligatoria y no debe contener numeros',
        })
        op=1;
    }
    if(departamento==null||departamento==''||!regExp2.test(departamento)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El departamento es obligatorio y no debe contener numeros',
        })
        op=1;
    }
    if(pais==null||pais==''||!regExp2.test(pais)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El pais es obligatorio y no debe contener numeros',
        })
        op=1;
    }
    if(causaMuerte==null||causaMuerte==''||!regExp2.test(causaMuerte)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La causa de muerte es obligatoria y no debe contener numeros',
        })
        op=1;
    }
    if(familiar==null||familiar==''||isNaN(familiar)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El familiar es obligatorio y solo debe contener numeros',
        })
        op=1;
    }
    if(relacion==null||relacion==''||!regExp2.test(relacion)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La relacion con el familiar es obligatoria y no debe contener numeros',
        })
        op=1;
    }
    if(nombreDr==null||nombreDr==''||!regExp2.test(nombreDr)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El nombre del doctor es obligatorio y no debe contener numeros',
        })
        op=1;
    }
    if(paternoDr==null||paternoDr==''||!regExp2.test(paternoDr)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El apellido paterno del doctor es obligatorio y no debe contener numeros',
        })
        op=1;
    }
    if(maternoDr==null||maternoDr==''||!regExp2.test(maternoDr)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El apellido materno del doctor es obligatorio y no debe contener numeros',
        })
        op=1;
    }
    if(carnetDr==null||carnetDr==''||isNaN(carnetDr)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El carnet del doctor es obligatorio y no debe contener numeros',
        })
        op=1;
    }

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
            }else if(respuesta=='mal'){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'El familiar no se encuentra registrado en el sistema',
                })
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


