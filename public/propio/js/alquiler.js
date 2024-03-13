function seleccionar(datos){
    dato=datos.split('||');
    document.getElementById("ModtxtId").innerHTML=dato[0];
    $("#ModtxtNombre").val(dato[1]);
    $("#ModtxtDescripcion").val(dato[2]);
    $("#ModtxtPrecio").val(dato[3]);
    $("#ModtxtDuracion").val(dato[4]);

}


function guardar(url,url2){
    var nombre = document.getElementById("txtNombre").value;
    var descripcion = document.getElementById("txtDescripcion").value;
    var precio = document.getElementById("txtPrecio").value;
    var duracion = document.getElementById("txtDuracion").value;

    var regExp1 = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g;
    var regExp2 = /[a-zA-Z]+/;

    


    var token = $('meta[name="csrf-token"]').attr('content');
    var guardar =
    "nombre="+nombre
    +"&descripcion="+descripcion
    +"&precio="+precio
    +"&duracion="+duracion
    +"&_token="+token;

 
    var op=0;

    if(nombre==null||nombre==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El nombre es obligatorio',
        })
        op=1;
    }

    if(descripcion==null||descripcion==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La descripcion es obligatoria',
        })
        op=1;
    }


    if(precio==null||precio==''||isNaN(precio)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El el precio es obligatorio y no debe contener letras',
        })
        op=1;
    }

    if(duracion==null||duracion==''||isNaN(duracion)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La duracion es obligatoria y no debe contener letras',
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
    }


}



function editar(url,url2){
    var id = document.getElementById("ModtxtId").innerHTML;
    var nombre = document.getElementById("ModtxtNombre").value;
    var descripcion = document.getElementById("ModtxtDescripcion").value;
    var precio = document.getElementById("ModtxtPrecio").value;
    var duracion = document.getElementById("ModtxtDuracion").value;


 

    var regExp1 = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g;
    var regExp2 = /[a-zA-Z]+/;

    var op=0;

    var op=0;

    if(nombre==null||nombre==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El nombre es obligatorio',
        })
        op=1;
    }

    if(descripcion==null||descripcion==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La descripcion es obligatoria',
        })
        op=1;
    }


    if(precio==null||precio==''||isNaN(precio)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El el precio es obligatorio y no debe contener letras',
        })
        op=1;
    }

    if(duracion==null||duracion==''||isNaN(duracion)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'La duracion es obligatoria y no debe contener letras',
        })
        op=1;
    }

 

    var token = $('meta[name="csrf-token"]').attr('content');
    var editar =
    "id="+id
    +"&nombre="+nombre
    +"&descripcion="+descripcion
    +"&precio="+precio
    +"&duracion="+duracion
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


function certificado(url){
    location.href=url;
}