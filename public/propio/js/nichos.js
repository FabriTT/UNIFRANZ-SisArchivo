var valorAnterior = "111";
function seleccionar(piso,fila,columna){
    document.getElementById("txtPiso").innerHTML=piso;
    document.getElementById("txtFila").innerHTML=fila;
    document.getElementById("txtColumna").innerHTML=columna;


        try {
            document.getElementById(valorAnterior).style.background="white";
            valorAnterior = piso+''+fila+''+columna;
            document.getElementById(piso+''+fila+''+columna).style.background="green";
        } catch (error) {
            valorAnterior = 111;
        }



}


function buscarCliente(url){
    var carnet = document.getElementById("txtCarnetCli").value;
    console.log(carnet);
    var token = $('meta[name="csrf-token"]').attr('content');
    var cliente =
    "carnet="+carnet 
    +"&_token="+token;

    var op=0;

    if(carnet==null||carnet==''||isNaN(carnet)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El carnet es obligatorio y solo debe contener numeros',
        })
        op=1;
    }

    
    if(op==0){
        $.ajax({
            url: url,
            type: 'POST',
            data: cliente,
        })
        .done(function(respuesta){
            
            if(respuesta=='mal'){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error:' + respuesta,
                })
                
            }else{
                document.getElementById("txtCliente").innerHTML=respuesta[0].name+" "+respuesta[0].paterno+" "+respuesta[0].materno
                document.getElementById("ECliente").innerHTML=respuesta[0].id
                var selectElement = document.getElementById('txtActa');
                for(i=0 ; i<respuesta.length ; i++){
                    var option = document.createElement('option'); // Paso 4
                    option.value = respuesta[i].id_act; // Paso 5: Establecer el valor de la opción
                    option.textContent = respuesta[i].nombres_act+" "+respuesta[i].paterno_act+" "+respuesta[i].materno_act; // Paso 5: Establecer el texto de la opción
                    selectElement.appendChild(option); // Paso 6: Agregar la opción al select
                }
            }
            
        });
    }

}


function buscarEmpleado(url){
    var carnet = document.getElementById("txtCarnetEmp").value;
    console.log(carnet);
    var token = $('meta[name="csrf-token"]').attr('content');
    var empleado =
    "carnet="+carnet 
    +"&_token="+token;

    var op=0;

    if(carnet==null||carnet==''||isNaN(carnet)){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'El carnet es obligatorio y solo debe contener numeros',
        })
        op=1;
    }

    
    if(op==0){
        $.ajax({
            url: url,
            type: 'POST',
            data: empleado,
        })
        .done(function(respuesta){
            
            if(respuesta=='mal'){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error:' + respuesta,
                })
                
            }else{
                document.getElementById("EEmpleado").innerHTML=respuesta.id
                document.getElementById("txtEmpleado").innerHTML=respuesta.name+" "+respuesta.paterno+" "+respuesta.materno
            }
            
        });
    }

}


function total(alquileres){
    var id = document.getElementById("txtAlquiler").value;
    
    for(i=0 ; i<alquileres.length ; i++){
        if(alquileres[i].id_alq==id){
            document.getElementById("txtTotal").innerHTML=alquileres[i].precio_alq+" Bs. ";
        }
    }
    
    
    
    
}


function iniciarMap(){
    var latitud = document.getElementById("Latitud").innerHTML;
    var longitud = document.getElementById("Longitud").innerHTML;
    console.log(latitud+" "+longitud);
    var coord = {lat:parseFloat(latitud) ,lng: parseFloat(longitud)};
    var map = new google.maps.Map(document.getElementById('map'),{
      zoom: 18,
      center: coord
    });
    var marker = new google.maps.Marker({
      position: coord,
      map: map
    });
}



function Guardar(url,url2){
    var cuartel = document.getElementById("ECuartel").innerHTML;
    var piso = document.getElementById("txtPiso").innerHTML;
    var fila = document.getElementById("txtFila").innerHTML;
    var columna = document.getElementById("txtColumna").innerHTML;
    var cliente = document.getElementById("ECliente").innerHTML;
    var familiar = document.getElementById("txtActa").value;
    var empleado = document.getElementById("EEmpleado").innerHTML;
    var alquiler = document.getElementById("txtAlquiler").value;

    var token = $('meta[name="csrf-token"]').attr('content');
    var guardar =
    "cuartel="+cuartel
    +"&piso="+piso
    +"&fila="+fila
    +"&columna="+columna
    +"&cliente="+cliente
    +"&familiar="+familiar
    +"&empleado="+empleado
    +"&alquiler="+alquiler
    +"&_token="+token;

    var op=0;

    if(piso==null||piso==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'No selecciono ningun nicho',
        })
        op=1;
    }

    if(fila==null||fila==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'No selecciono ningun nicho',
        })
        op=1;
    }

    if(columna==null||columna==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'No selecciono ningun nicho',
        })
        op=1;
    }

    if(cliente==null||cliente==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'No hay un cliente para realizar el registro',
        })
        op=1;
    }

    if(familiar==null||familiar==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'No selecciono un familiar del cliente',
        })
        op=1;
    }

    if(empleado==null||empleado==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'No hay un empleado para realizar el registro',
        })
        op=1;
    }

    if(alquiler==null||alquiler==''){
        Swal.fire({
            icon: 'warning',
            title: 'Sugerencia',
            text: 'No selecciono ningun tipo de alquiler',
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