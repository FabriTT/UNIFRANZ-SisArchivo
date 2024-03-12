jQuery(document).ready(function () {
    // Recuperar las variables de localStorage
    var showModal = localStorage.getItem("Modal");
    var Nombre = localStorage.getItem("Nombre");
    var Carnet = localStorage.getItem("Carnet");
    if (showModal === "1") {
        // Asegúrate de que el modal esté cargado antes de intentar mostrarlo
        if (jQuery("#Documentos").length > 0) {
            // Abre el modal
            Mostrar(Nombre, Carnet, historial, direccion);
            jQuery("#Documentos").modal("show");
        } else {
            console.error("El modal no está presente en el DOM.");
        }

        // Limpiar las variables de localStorage después de usarlas si es necesario
        localStorage.removeItem("Modal");
        localStorage.removeItem("Nombre");
        localStorage.removeItem("Carnet");
    }
});

function Mostrar(nombre, carnet, ruta, direccion) {
    document.getElementById("nombre").value = nombre;
    document.getElementById("carnet").value = carnet;

    Swal.fire({
        title: "Cargando...",
        allowOutsideClick: false,
        showConfirmButton: false,
        onBeforeOpen: () => {
            Swal.showLoading();
        },
    });
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: ruta,
        type: "GET",
        data: "carnet=" + carnet,
        processData: false,
        contentType: false,
    }).done(function (respuesta) {
        Swal.close();
        var historiales = respuesta.historiales;

        var tabla = document.getElementById("TablaDocumentos");

        // Obtener la referencia al cuerpo de la tabla
        var tbody = tabla.getElementsByTagName("tbody")[0];
        while (tbody.firstChild) {
            tbody.removeChild(tbody.firstChild);
        }
        // Llenar la tabla con los datos
        for (var i = 0; i < historiales.length; i++) {
            // Crear una nueva fila
            var fila = tbody.insertRow(i);

            var boton = document.createElement("button");
            boton.type = "button";
            boton.className = "btn btn-icon btn-round btn-danger";
            var icono = document.createElement("i");
            icono.className = "fa fa-trash";
            (function (indice) {
                boton.onclick = function () {
                    borrarArchivo(historiales[indice].Fotocopia_com);
                };
            })(i);
            boton.appendChild(icono);

            var enlace = document.createElement("a");
            enlace.type = "button";
            enlace.className = "btn btn-default btn-round";
            enlace.innerText = "ABRIR";
            enlace.href = direccion + "/" + historiales[i].Fotocopia_com; // Aquí debes especificar la URL deseada

            // Insertar celdas en la fila
            var celda1 = fila.insertCell(0);
            var celda2 = fila.insertCell(1);
            var celda3 = fila.insertCell(2);
            var celda4 = fila.insertCell(3);

            if (permisoBorrarDocumento == 1) {
                var celda5 = fila.insertCell(4);
            }

            // Llenar las celdas con los datos
            celda1.innerHTML = historiales[i].Tipo_com;
            celda2.innerHTML = historiales[i].Descripcion_com;
            celda3.innerHTML = historiales[i].Fecha_com;
            celda4.appendChild(enlace);

            if (permisoBorrarDocumento == 1) {
                celda5.appendChild(boton);
            }
        }
    });
}

function Insertar(ruta, ruta2, ruta3) {
    var contenedor = document.getElementById("divErrorModificar");
    var mensaje = document.getElementById("errorModificar");

    var tipo = document.getElementById("tipo");
    var descripcion = document.getElementById("descripcion");
    var fecha = document.getElementById("fecha");
    var fotocopia = document.getElementById("fotocopia");

    var nombre = document.getElementById("nombre");
    var carnet = document.getElementById("carnet");

    var validado = true;

    //Validar Vacios
    validado = validado && validarVacio(tipo, contenedor, mensaje);
    validado = validado && validarVacio(descripcion, contenedor, mensaje);
    validado = validado && validarVacio(fecha, contenedor, mensaje);
    validado = validado && validarVacio(fotocopia, contenedor, mensaje);

    //Validar fecha
    validado = validado && validarFecha(fecha, contenedor, mensaje);
    //Validar Archivo
    validado = validado && validarArchivos(fotocopia, contenedor, mensaje);

    var form = document.getElementById("form-documento");
    var formData = new FormData(form);

    if (validado) {
        Swal.fire({
            title: "Cargando...",
            allowOutsideClick: false,
            showConfirmButton: false,
            onBeforeOpen: () => {
                Swal.showLoading();
            },
        });
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: "POST",
            url: ruta,
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                Swal.close();
                if (response == "ok") {
                    Swal.fire({
                        title: "¡Registro exitoso!",
                        text: "Almacenado en la base de datos.",
                        icon: "success",
                        showDenyButton: true,
                        showCancelButton: true,
                        confirmButtonText: "Actualizar",
                        cancelButtonText: "Siguiente registro ", // Cambiado el orden del tercer botón
                        denyButtonText: `Agregar otro titulo`,
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: "swal-button swal-button--confirm",
                            cancelButton: "swal-button swal-button--deny",
                            denyButton: "swal-button swal-button--cancel",
                        },
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.replace(ruta2);
                        } else if (result.isDenied) {
                            localStorage.setItem("Modal", "1");
                            localStorage.setItem("Nombre", nombre.value);
                            localStorage.setItem("Carnet", carnet.value);
                            window.location.replace(ruta2);
                        } else if (result.isDismissed) {
                            localStorage.setItem("Modal", "1");
                            localStorage.setItem("Nombre", nombre.value);
                            localStorage.setItem("Carnet", carnet.value);
                            window.location.replace(ruta3);
                        }
                    });
                } else {
                    Swal.fire({
                        title: "¡Error!",
                        text: "Error al guardar en la base de datos",
                        icon: "error",
                        confirmButtonText: "OK",
                    });
                }
            },
        });
    }
}

function validarFecha(input, contenedor, mensaje) {
    var fechaSeleccionada = new Date(input.value);
    var fechaActual = new Date();

    // Establecer la hora de la fecha actual a las 00:00:00 para comparar solo la fecha
    fechaActual.setHours(0, 0, 0, 0);

    if (isNaN(fechaSeleccionada) || fechaSeleccionada > fechaActual) {
        input.style.borderColor = "red";
        contenedor.style.borderColor = "red";
        mensaje.innerHTML = "La fecha debe ser de hoy hacia atrás.";
        return false;
    } else {
        input.style.borderColor = "black";
        contenedor.style.borderColor = "white";
        mensaje.innerHTML = "";
        return true;
    }
}

function validarVacio(input, contenedor, mensaje) {
    if (input.value == "") {
        input.style.borderColor = "red";
        contenedor.style.borderColor = "red";
        mensaje.innerHTML = "Los campos resaltados en rojo son obligatorios";
        return false;
    } else {
        input.style.borderColor = "black";
        contenedor.style.borderColor = "white";
        mensaje.innerHTML = "";
        return true;
    }
}

function validarArchivos(input, contenedor, mensaje) {
    var archivosSeleccionados = input.files;
    for (var i = 0; i < archivosSeleccionados.length; i++) {
        var tipoArchivo = archivosSeleccionados[i].type;

        // Verificar que sea un PDF o una imagen
        if (
            tipoArchivo !== "application/pdf" &&
            !tipoArchivo.startsWith("image/")
        ) {
            input.style.borderColor = "red";
            contenedor.style.borderColor = "red";
            mensaje.innerHTML =
                "El archivo seleccionado debe ser PDF o una imagen";
            return false;
        } else {
            input.style.borderColor = "black";
            contenedor.style.borderColor = "white";
            mensaje.innerHTML = "";
            return true;
        }
    }
}

function borrarArchivo(archivo) {
    var token = $('meta[name="csrf-token"]').attr("content"); // Obtén el token CSRF
    var datos = "archivo=" + archivo + "&_token=" + token;

    Swal.fire({
        title: "¿Estás seguro de eliminar el archivo?",
        showDenyButton: true,
        confirmButtonText: "Aceptar",
        denyButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Cargando...",
                allowOutsideClick: false,
                showConfirmButton: false,
                onBeforeOpen: () => {
                    Swal.showLoading();
                },
            });
            $.ajax({
                url: rutaBorrar,
                type: "POST",
                data: datos,
            }).done(function (response) {
                Swal.close();
                if (response == "ok") {
                    Swal.fire({
                        title: "¡Archivo eliminado!",
                        text: "Archivo eliminado de la carpeta.",
                        icon: "success",
                        confirmButtonText: "Continuar",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            localStorage.setItem("Modal", "1");
                            localStorage.setItem("Nombre", nombre.value);
                            localStorage.setItem("Carnet", carnet.value);
                            window.location.replace(rutaCargar);
                        }
                    });
                } else {
                    Swal.fire({
                        title: "¡Error!",
                        text: "Error al guardar en la base de datos" + response,
                        icon: "error",
                        confirmButtonText: "OK",
                    });
                }
            });
        } else if (result.isDenied) {
            Swal.fire("Cancelado", "", "info");
        }
    });
}
