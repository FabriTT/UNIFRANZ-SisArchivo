function seleccionar(datos){
    dato=datos.split('||');
    document.getElementById("ModtxtId").innerHTML=dato[0];
    $("#ModtxtNombre").val(dato[1]);
    document.getElementById("ModtxtTipo").text=dato[2];
    document.getElementById("ModtxtTipo").value=dato[2];
    $("#ModtxtDescuento").val(dato[3]);
    $("#ModtxtCapacidad").val(dato[4]);
    $("#ModtxtPisos").val(dato[5]);
    $("#ModtxtNfilas").val(dato[6]);
    $("#ModtxtNcolumnas").val(dato[7]);
    $("#ModtxtLatitud").val(dato[8]);
    $("#ModtxtLongitud").val(dato[9]);
    document.getElementById("ModtxtSector").text=dato[10];
    document.getElementById("ModtxtSector").value=dato[10];
    $("#ModtxtCalle").val(dato[11]);

}


function guardar(url,url2){
    var nombre = document.getElementById("txtNombre").value;
    var tipo = document.getElementById("txtTipo").value;
    var descuento = document.getElementById("txtDescuento").value;
    var pisos = document.getElementById("txtPisos").value;
    var nfilas = document.getElementById("txtNfilas").value;
    var ncolumnas = document.getElementById("txtNcolumnas").value;
    var latitud = document.getElementById("txtLatitud").value;
    var longitud = document.getElementById("txtLongitud").value;
    var sector = document.getElementById("txtSector").value;
    var calle = document.getElementById("txtCalle").value;





    var regExp1 = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g;
    var regExp2 = /[a-zA-Z]+/;

    


    var token = $('meta[name="csrf-token"]').attr('content');
    var guardar =
    "nombre="+nombre
    +"&tipo="+tipo
    +"&descuento="+descuento
    +"&pisos="+pisos
    +"&nfilas="+nfilas
    +"&ncolumnas="+ncolumnas
    +"&latitud="+latitud
    +"&longitud="+longitud
    +"&sector="+sector
    +"&calle="+calle
    +"&_token="+token;

 
    var op=0;

    if(nombre==null||nombre==''||!regExp2.test(nombre)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El nombre es obligatorio y no debe contener numeros',
        })
        op=1;
    }
    if(tipo==null||tipo==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El tipo es obligatorio',
        })
        op=1;
    }
    if(descuento==null||descuento==''||isNaN(descuento)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El descuento es obligatorio y no debe contener numeros',
        })
        op=1;
    }


    if(pisos==null||pisos==''||isNaN(pisos)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El numero de pisos es obligatorio y no debe contener letras',
        })
        op=1;
    }

    if(nfilas==null||nfilas==''||isNaN(nfilas)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El numero de filas es obligatorio y no debe contener letras',
        })
        op=1;
    }

    if(ncolumnas==null||ncolumnas==''||isNaN(ncolumnas)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El numero de columnas es obligatorio y no debe contener letras',
        })
        op=1;
    }

    if(latitud==null||latitud==''||isNaN(latitud)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La latitud es obligatoria y no debe contener letras',
        })
        op=1;
    }

    if(longitud==null||longitud==''||isNaN(longitud)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La longitud es obligatoria y no debe contener letras',
        })
        op=1;
    }

    if(sector==null||sector==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El sector es obligatorio y no debe contener numeros',
        })
        op=1;
    }

    if(calle==null||calle==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La calle es obligatoria y no debe contener numeros',
        })
        op=1;
    }

    if(op==0){
        Swal.fire({
            title: 'Esta seguro de realizar el registro? No se podra modificar los pisos, las filas y columnas que conforman al cuartel y tambien se generaran los registros de los nichos',
            showDenyButton: true,
            confirmButtonText: 'Aceptar',
            denyButtonText: `Cancelar`,
          }).then((result) => {
            if (result.isConfirmed) {
               
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: guardar,
                })
                .done(function(respuesta){
                    console.log(respuesta)
                    
                    if(respuesta=='ok'){
                        Swal.fire({
                            icon: 'success',
                            title: 'Correcto',
                            text: 'Se registro exitosamente',
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
                
            } else if (result.isDenied) {
              Swal.fire('Cancelado', '', 'info')
            }
          })

        
    }


}



function editar(url,url2){
    var id = document.getElementById("ModtxtId").innerHTML;
    var nombre = document.getElementById("ModtxtNombre").value;
    var tipo = document.getElementById("ModtxtTipo").value;
    var descuento = document.getElementById("ModtxtDescuento").value;
    var pisos = document.getElementById("ModtxtPisos").value;
    var nfilas = document.getElementById("ModtxtNfilas").value;
    var ncolumnas = document.getElementById("ModtxtNcolumnas").value;
    var latitud = document.getElementById("ModtxtLatitud").value;
    var longitud = document.getElementById("ModtxtLongitud").value;
    var sector = document.getElementById("ModtxtSector").value;
    var calle = document.getElementById("ModtxtCalle").value;


    var regExp1 = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g;
    var regExp2 = /[a-zA-Z]+/;

    var op=0;

    if(nombre==null||nombre==''||!regExp2.test(nombre)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El nombre es obligatorio y no debe contener numeros',
        })
        op=1;
    }
    if(tipo==null||tipo==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El tipo es obligatorio',
        })
        op=1;
    }
    if(descuento==null||descuento==''||isNaN(descuento)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El descuento es obligatorio y no debe contener numeros',
        })
        op=1;
    }


    if(pisos==null||pisos==''||isNaN(pisos)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El numero de pisos es obligatorio y no debe contener letras',
        })
        op=1;
    }

    if(nfilas==null||nfilas==''||isNaN(nfilas)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El numero de filas es obligatorio y no debe contener letras',
        })
        op=1;
    }

    if(ncolumnas==null||ncolumnas==''||isNaN(ncolumnas)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El numero de columnas es obligatorio y no debe contener letras',
        })
        op=1;
    }

    if(latitud==null||latitud==''||isNaN(latitud)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La latitud es obligatoria y no debe contener letras',
        })
        op=1;
    }

    if(longitud==null||longitud==''||isNaN(longitud)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La longitud es obligatoria y no debe contener letras',
        })
        op=1;
    }

    if(sector==null||sector==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El sector es obligatorio y no debe contener numeros',
        })
        op=1;
    }

    if(calle==null||calle==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La calle es obligatoria y no debe contener numeros',
        })
        op=1;
    }

 

    var token = $('meta[name="csrf-token"]').attr('content');
    var editar =
    "id="+id
    +"&nombre="+nombre
    +"&tipo="+tipo
    +"&descuento="+descuento
    +"&pisos="+pisos
    +"&nfilas="+nfilas
    +"&ncolumnas="+ncolumnas
    +"&latitud="+latitud
    +"&longitud="+longitud
    +"&sector="+sector
    +"&calle="+calle
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

