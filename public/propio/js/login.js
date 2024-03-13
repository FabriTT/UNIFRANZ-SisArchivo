
function ocultar(){
    var x =document.getElementById("password");
    if(x.type=="password"){
        x.type="text";
   }else{
        x.type="password";
   }

}

function validar(url,url1,url2){
    
    var x = document.getElementById("contador").value;
    var correo = document.getElementById("correo").value;
    var password = document.getElementById("password").value;
    var token = $('meta[name="csrf-token"]').attr('content');

    var info = "correo="+correo+"&password="+password+"&_token="+token;

    if(correo == '' || password == ''){

        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El usuario y la contraseña son campos obligatorios',
        })

    }else{

        $.ajax({
            url: url,
            type: 'POST',
            data: info,
        })
        .done(function(respuesta){
            
            
            if(Object.keys(respuesta).length > 0){
    
                
                var opciones = {};
                for (var elemento of respuesta) {
                    //console.log(elemento['id_car'])
                    var id_car = elemento['descripcion_car']
                    opciones[id_car] = id_car
                }
                  Swal.fire({
                    title: 'Inicio de sesión correcta',
                    text: '¿Con que rol desea acceder?',
                    input: 'select',
                    inputOptions: opciones,
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    icon: 'success'
                  }).then((resultado) => {
                    if (resultado.isConfirmed) {
                       console.log(resultado.value)
                       if(resultado.value=="Cliente regular"){
                            
                            window.location.href = 'http://sistemacg.test/dashboard2';

                       }else{
                           
                            window.location.href = 'http://sistemacg.test/dashboard1';

                       }
                      
                    }
                  });
    
            }else{
                x++;
                document.getElementById("contador").value=x;
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Usted no se encuentra registrado o los datos que ingreso son incorrectos',
                })
                if(x>3){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Usted realizo demasiados intentos puede cambiar su contraseña con el siguiente link',
                        footer: '<a href="#">¿Olvidaste tu contraseña?</a>'
                    })
                }
            }
        });

    }
    
}


window.onload = function() {

    var contador = document.getElementById("contador").value;
    console.log(parseInt(contador));

    if (parseInt(contador) >= 3) {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Usted realizó demasiados intentos. Puede cambiar su contraseña con el siguiente enlace.',
        footer: '<a href="#">¿Olvidaste tu contraseña?</a>'
    });
    } else if (parseInt(contador)>0) {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Usted no se encuentra registrado o los datos que ingresó son incorrectos.'
    });
    }

}
  
