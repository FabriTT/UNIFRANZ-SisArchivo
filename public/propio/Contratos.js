jQuery(document).ready(function () {
    // Recuperar las variables de localStorage
    var showModal = localStorage.getItem('Modal');
    var Nombre = localStorage.getItem('Nombre');
    var Carnet = localStorage.getItem('Carnet');
    if (showModal === '1') {
        // Asegúrate de que el modal esté cargado antes de intentar mostrarlo
        if (jQuery('#Contratos').length > 0) {
            // Abre el modal
            Mostrar(Nombre,Carnet,historial,direccion);
            jQuery('#Contratos').modal('show');
            
        } else {
            console.error('El modal no está presente en el DOM.');
        }

        // Limpiar las variables de localStorage después de usarlas si es necesario
        localStorage.removeItem('Modal');
        localStorage.removeItem('Nombre');
        localStorage.removeItem('Carnet');
    }
});


function Mostrar(nombre,carnet, ruta, direccion) {
    document.getElementById("nombre").value = nombre;
    document.getElementById("carnet").value = carnet;
    Swal.fire({
        title: 'Cargando...',
        allowOutsideClick: false,
        showConfirmButton: false,
        onBeforeOpen: () => {
            Swal.showLoading();
        }
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: ruta,
        type: 'GET',
        data: "carnet=" + carnet,
        processData: false,
        contentType: false,
    })
        .done(function (respuesta) {
            Swal.close();
            var contratos = respuesta.contratos;

            var tabla = document.getElementById("TablaContratos");

            // Obtener la referencia al cuerpo de la tabla
            var tbody = tabla.getElementsByTagName("tbody")[0];
            while (tbody.firstChild) {
                tbody.removeChild(tbody.firstChild);
            }
            // Llenar la tabla con los datos
            for (var i = 0; i < contratos.length; i++) {
                // Crear una nueva fila
                var fila = tbody.insertRow(i);

                var boton = document.createElement("button");
                boton.type = "button";
                boton.className = "btn btn-icon btn-round btn-primary";
                var icono = document.createElement("i");
                icono.className = "fa fa-file-alt";
                (function (indice) {
                    boton.onclick = function () {
                        $('#Evaluaciones').modal('show');
                        document.getElementById("calificacion").value=contratos[indice].Calificacion_evaluacion_con;
                        document.getElementById("fechaEvaluacion").value=contratos[indice].Fecha_evaluacion_con;
                        document.getElementById("IdContrato").value=contratos[indice].Id_con;
                        document.getElementById("nombre2").value=nombre;
                        document.getElementById("carnet2").value=carnet;
                    };
                })(i);
                boton.appendChild(icono);

                var boton2 = document.createElement("button");
                boton2.type = "button";
                boton2.className = "btn btn-icon btn-round btn-danger";
                var icono = document.createElement("i");
                icono.className = "fa fa-trash";
                (function (indice) {
                    boton2.onclick = function () {
                        borrarArchivo(contratos[indice].Id_con);
                    };
                })(i);
                boton2.appendChild(icono);
                

                var enlace = document.createElement("a");
                enlace.type = "button";
                enlace.className = "btn btn-default btn-round";
                enlace.innerText = "ABRIR";
                enlace.href = direccion+'/'+contratos[i].Foto_contrato_con;
                
                var enlace2 = document.createElement("a");
                enlace2.type = "button";
                enlace2.className = "btn btn-default btn-round";
                enlace2.innerText = "ABRIR";
                enlace2.href = direccion+'/'+contratos[i].Foto_evaluacion_con;

                var dato = document.createElement("span");
                dato.className = "badge bg-success";
                dato.innerText = "VIGENTE";

                var dato2 = document.createElement("span");
                dato2.className = "badge bg-danger";
                dato2.innerText = "CONCLUIDO";

                // Insertar celdas en la fila
                var celda1 = fila.insertCell(0);
                var celda2 = fila.insertCell(1);
                var celda3 = fila.insertCell(2);
                var celda4 = fila.insertCell(3);
                var celda5 = fila.insertCell(4);
                var celda6 = fila.insertCell(5);
                var celda7 = fila.insertCell(6);
                
                if (permisoGuardarContrato == 1) {
                    var celda8 = fila.insertCell(7);
                }
                if (permisoBorrarContrato == 1) {
                    var celda9 = fila.insertCell(8);
                }


                // Llenar las celdas con los datos
                celda1.innerHTML = contratos[i].Materia_con;
                celda2.innerHTML = contratos[i].Fecha_con;
                celda3.appendChild(enlace);
                celda4.innerHTML = contratos[i].Fecha_evaluacion_con;
                celda5.innerHTML = contratos[i].Calificacion_evaluacion_con;
                if(contratos[i].Foto_evaluacion_con!==null && contratos[i].Foto_evaluacion_con!==undefined){
                    celda6.appendChild(enlace2);
                }
                
                if (contratos[i].Estado_con == 1) {
                    celda7.appendChild(dato);
                } else if (contratos[i].Estado_con == 0) {
                    celda7.appendChild(dato2);
                }
                
                if (permisoGuardarContrato == 1) {
                    celda8.appendChild(boton);
                }
                if (permisoBorrarContrato == 1) {
                    celda9.appendChild(boton2);
                }

            }

        });
}



function InsertarContrato(ruta, ruta2) {
    var contenedor = document.getElementById("divErrorDesactivar");
    var mensaje = document.getElementById("errorDesactivar");

    var materia = document.getElementById("materia");
    var fecha = document.getElementById("fechaContrato");
    var fechafin = document.getElementById("fechaFinContrato");
    var fotocopia = document.getElementById("fotocopiaContrato");

    var nombre = document.getElementById("nombre");
    var carnet = document.getElementById("carnet");

    var validado = true;

    //Validar Vacios
    validado = validado && validarVacio(materia, contenedor, mensaje);
    validado = validado && validarVacio(fecha, contenedor, mensaje);
    validado = validado && validarVacio(fechafin, contenedor, mensaje);
    validado = validado && validarVacio(fotocopia, contenedor, mensaje);

    //Validar fecha
    validado = validado && validarFecha(fecha, contenedor, mensaje);
    validado = validado && validarFecha2(fechafin, contenedor, mensaje);
    //Validar Archivo
    validado = validado && validarArchivos(fotocopia, contenedor, mensaje);


    var form = document.getElementById("form-contrato");
    var formData = new FormData(form);

    if (validado) {
        Swal.fire({
            title: 'Cargando...',
            allowOutsideClick: false,
            showConfirmButton: false,
            onBeforeOpen: () => {
                Swal.showLoading();
            }
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: ruta,
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                Swal.close();
                if (response == 'ok') {
                    Swal.fire({
                        title: '¡Registro exitoso!',
                        text: 'Almacenado en la base de datos.',
                        icon: 'success',
                        showDenyButton: true,
                        confirmButtonText: "Actualizar",
                        denyButtonText: `Agregar otro contrato`,
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: 'swal-button swal-button--confirm',
                            denyButton: 'swal-button swal-button--cancel'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.replace(ruta2);
                        } else if (result.isDenied) {
                            localStorage.setItem('Modal', '1');
                            localStorage.setItem('Nombre', nombre.value);
                            localStorage.setItem('Carnet', carnet.value);
                            window.location.replace(ruta2);
                        }
                    });
                    
                    


                } else {
                    Swal.fire({
                        title: '¡Error!',
                        html: 'Error al guardar en la base de datos:'+response,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            }
        });
    }

}



function InsertarEvaluacion(ruta, ruta2) {
    var contenedor = document.getElementById("divErrorEvaluacion");
    var mensaje = document.getElementById("errorEvaluacion");

    var calificacion = document.getElementById("calificacion");
    var fecha = document.getElementById("fechaEvaluacion");
    var fotocopia = document.getElementById("fotocopiaEvaluacion");

    var nombre2 = document.getElementById("nombre2");
    var carnet2 = document.getElementById("carnet2");

    var validado = true;

    //Validar Vacios
    validado = validado && validarVacio(calificacion, contenedor, mensaje);
    validado = validado && validarVacio(fecha, contenedor, mensaje);
    validado = validado && validarVacio(fotocopia, contenedor, mensaje);

    //Validar numeros
    validado = validado && validarNumeros(calificacion, contenedor, mensaje);
    //Validar fecha
    validado = validado && validarFecha(fecha, contenedor, mensaje);
    //Validar Archivo
    validado = validado && validarArchivos(fotocopia, contenedor, mensaje);


    var form = document.getElementById("form-evaluacion");
    var formData = new FormData(form);

    if (validado) {
        Swal.fire({
            title: 'Cargando...',
            allowOutsideClick: false,
            showConfirmButton: false,
            onBeforeOpen: () => {
                Swal.showLoading();
            }
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: ruta,
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                Swal.close();
                if (response == 'ok') {
                    Swal.fire({
                        title: '¡Registro exitoso!',
                        text: 'Almacenado en la base de datos.',
                        icon: 'success',
                        showDenyButton: true,
                        confirmButtonText: "Actualizar",
                        denyButtonText: `Agregar otro contrato`,
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: 'swal-button swal-button--confirm',
                            denyButton: 'swal-button swal-button--cancel'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.replace(ruta2);
                        } else if (result.isDenied) {
                            localStorage.setItem('Modal', '1');
                            localStorage.setItem('Nombre', nombre2.value);
                            localStorage.setItem('Carnet', carnet2.value);
                            window.location.replace(ruta2);
                        }
                    });
                    
                    


                } else {
                    Swal.fire({
                        title: '¡Error!',
                        text: 'Error al guardar en la base de datos',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            }
        });
    }

}


function validarFecha(input, contenedor, mensaje) {
    var fechaSeleccionada = new Date(input.value);
    var fechaActual = new Date();

    // Establecer la hora de la fecha actual a las 00:00:00 para comparar solo la fecha
    fechaActual.setHours(0, 0, 0, 0);

    if (isNaN(fechaSeleccionada) || fechaSeleccionada > fechaActual) {
        input.style.borderColor = 'red';
        contenedor.style.borderColor = 'red';
        mensaje.innerHTML = 'La fecha debe ser de hoy hacia atrás.';
        return false;
    } else {
        input.style.borderColor = 'black';
        contenedor.style.borderColor = 'white';
        mensaje.innerHTML = "";
        return true;
    }
}

function validarFecha2(input, contenedor, mensaje) {
    var fechaSeleccionada = new Date(input.value);
    var fechaActual = new Date();

    // Establecer la hora de la fecha actual a las 00:00:00 para comparar solo la fecha
    fechaActual.setHours(0, 0, 0, 0);

    if (isNaN(fechaSeleccionada) || fechaSeleccionada < fechaActual) {
        input.style.borderColor = 'red';
        contenedor.style.borderColor = 'red';
        mensaje.innerHTML = 'La fecha debe ser de hoy en adelante.';
        return false;
    } else {
        input.style.borderColor = 'black';
        contenedor.style.borderColor = 'white';
        mensaje.innerHTML = "";
        return true;
    }
}


function validarVacio(input, contenedor, mensaje) {
    if (input.value == '') {
        input.style.borderColor = 'red';
        contenedor.style.borderColor = 'red';
        mensaje.innerHTML = "Los campos resaltados en rojo son obligatorios";
        return false;
    } else {
        input.style.borderColor = 'black';
        contenedor.style.borderColor = 'white';
        mensaje.innerHTML = "";
        return true;
    }

}


function validarArchivos(input, contenedor, mensaje) {
    var archivosSeleccionados = input.files;
    for (var i = 0; i < archivosSeleccionados.length; i++) {
        var tipoArchivo = archivosSeleccionados[i].type;

        // Verificar que sea un PDF o una imagen
        if (tipoArchivo !== 'application/pdf' && !tipoArchivo.startsWith('image/')) {
            input.style.borderColor = 'red';
            contenedor.style.borderColor = 'red';
            mensaje.innerHTML = "El archivo seleccionado debe ser PDF o una imagen";
            return false;
        } else {
            input.style.borderColor = 'black';
            contenedor.style.borderColor = 'white';
            mensaje.innerHTML = "";
            return true;
        }
    }

}

function validarNumeros(input, contenedor, mensaje) {
    var expresion = /^[0-9]+$/;
    if (!expresion.test(input.value)) {
        input.style.borderColor = 'red';
        contenedor.style.borderColor = 'red';
        mensaje.innerHTML = "El campo resaltado en rojo solo acepta numeros";
        return false;
    } else {
        input.style.borderColor = 'black';
        contenedor.style.borderColor = 'white';
        mensaje.innerHTML = "";
        return true;
    }

}

function borrarArchivo(id) {
    var token = $('meta[name="csrf-token"]').attr('content'); // Obtén el token CSRF
    var datos = "id=" + id + "&_token=" + token;


    Swal.fire({
        title: '¿Estás seguro de eliminar el archivo?',
        showDenyButton: true,
        confirmButtonText: 'Aceptar',
        denyButtonText: 'Cancelar',
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Cargando...',
                allowOutsideClick: false,
                showConfirmButton: false,
                onBeforeOpen: () => {
                    Swal.showLoading();
                }
            });
            $.ajax({
                url: rutaBorrar,
                type: 'POST',
                data: datos,
            })
                .done(function (response) {
                    Swal.close();
                    if (response == 'ok') {
                        Swal.fire({
                            title: '¡Archivo eliminado!',
                            text: 'Archivo eliminado de la carpeta.',
                            icon: 'success',
                            confirmButtonText: 'Continuar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                localStorage.setItem('Modal', '1');
                                localStorage.setItem('Nombre', nombre.value);
                                localStorage.setItem('Carnet', carnet.value);
                                window.location.replace(rutaCargar);
                            }
                        });
                    } else {
                        Swal.fire({
                            title: '¡Error!',
                            text: 'Error al guardar en la base de datos' + response,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });

        } else if (result.isDenied) {
            Swal.fire('Cancelado', '', 'info');
        }
    });
}