jQuery(document).ready(function () {
    // Recuperar las variables de localStorage
    var showModal = localStorage.getItem("Modal");
    var Nombre = localStorage.getItem("Nombre");
    var Carnet = localStorage.getItem("Carnet");
    if (showModal === "1") {
        // Asegúrate de que el modal esté cargado antes de intentar mostrarlo
        if (jQuery("#Clase_modelo").length > 0) {
            // Abre el modal
            jQuery("#Clase_modelo").modal("show");

            var token = $('meta[name="csrf-token"]').attr("content"); // Obtén el token CSRF
            var datos = "carnet=" + Carnet + "&_token=" + token;

            $.ajax({
                url: buscar,
                type: "POST",
                data: datos,
            }).done(function (respuesta) {
                var docente = respuesta.docente;
                jQuery("#Modnombre").val(Nombre);
                jQuery("#Modcarnet").val(Carnet);
                jQuery("#Modfechaclase").val(docente[0].Fecha_clase_modelo_doc);
                jQuery("#Modfechaevaluar").val(docente[0].Fecha_evaluar_doc);
                jQuery("#Modcalificacion").val(
                    docente[0].Calificacion_evaluar_doc
                );
            });
        } else {
            console.error("El modal no está presente en el DOM.");
        }

        // Limpiar las variables de localStorage después de usarlas si es necesario
        localStorage.removeItem("Modal");
        localStorage.removeItem("Nombre");
        localStorage.removeItem("Carnet");
    }
});

function seleccionar(datos) {
    var datosObj = JSON.parse(datos);

    document.getElementById("Modnombre").value =
        datosObj.Nombres_doc +
        " " +
        datosObj.Paterno_doc +
        " " +
        datosObj.Materno_doc;
    document.getElementById("Modcarnet").value = datosObj.Carnet_doc;
    document.getElementById("Modfechaclase").value =
        datosObj.Fecha_clase_modelo_doc;
    document.getElementById("Modfechaevaluar").value =
        datosObj.Fecha_evaluar_doc;
    document.getElementById("Modcalificacion").value =
        datosObj.Calificacion_evaluar_doc;
}

function Modificar(ruta, ruta2, ruta3) {
    var contenedor = document.getElementById("divErrorModificar");
    var mensaje = document.getElementById("errorModificar");

    var nombre = document.getElementById("Modnombre");
    var carnet = document.getElementById("Modcarnet");

    var fechaclase = document.getElementById("Modfechaclase");
    var fotoclase = document.getElementById("Modfotoclase");
    var fechaevaluar = document.getElementById("Modfechaevaluar");
    var fotoevaluar = document.getElementById("Modfotoevaluar");
    var calificacion = document.getElementById("Modcalificacion");

    var validado = true;

    //Validar Vacios
    validado = validado && validarVacio(fechaclase, contenedor, mensaje);
    validado = validado && validarVacio(fotoclase, contenedor, mensaje);
    validado = validado && validarVacio(fechaevaluar, contenedor, mensaje);
    validado = validado && validarVacio(fotoevaluar, contenedor, mensaje);
    validado = validado && validarVacio(calificacion, contenedor, mensaje);

    //validar fechas
    validado = validado && validarFecha(fechaclase, contenedor, mensaje);
    validado = validado && validarFecha(fechaevaluar, contenedor, mensaje);

    //validar numeros
    validado = validado && validarNumeros(calificacion, contenedor, mensaje);

    //validar archivos
    if (
        fotoclase !== null &&
        fotoclase !== undefined &&
        fotoclase.files.length > 0
    ) {
        validado = validado && validarArchivos(fotoclase, contenedor, mensaje);
    }
    if (
        fotoevaluar !== null &&
        fotoevaluar !== undefined &&
        fotoevaluar.files.length > 0
    ) {
        validado =
            validado && validarArchivos(fotoevaluar, contenedor, mensaje);
    }

    var form = document.getElementById("form-modificar");
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
                        confirmButtonText: "Actualizar",
                        denyButtonText: `Siguiente registro`,
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: "swal-button swal-button--confirm", // Clase personalizada para el botón de confirmar
                            denyButton: "swal-button swal-button--deny", // Clase personalizada para el botón de denegar
                        },
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.replace(ruta2);
                        } else if (result.isDenied) {
                            localStorage.setItem("Modal", "1");
                            localStorage.setItem("Nombre", nombre.value);
                            localStorage.setItem("Carnet", carnet.value);
                            window.location.replace(ruta3);
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
            },
        });
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

function validarNumeros(input, contenedor, mensaje) {
    var expresion = /^[0-9]+$/;
    if (!expresion.test(input.value)) {
        input.style.borderColor = "red";
        contenedor.style.borderColor = "red";
        mensaje.innerHTML = "El campo resaltado en rojo solo acepta numeros";
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

function HistoClase(datos, ruta, direccion, rutaBorrar) {
    var datosObj = JSON.parse(datos);
    var carpeta =
        datosObj.Nombres_doc.toUpperCase() +
        " " +
        datosObj.Paterno_doc.toUpperCase() +
        " " +
        datosObj.Materno_doc.toUpperCase() +
        " " +
        datosObj.Carnet_doc;
    document.getElementById("carpeta").value = carpeta;
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
        data: "carpeta=" + carpeta,
        processData: false,
        contentType: false,
    }).done(function (respuesta) {
        Swal.close();
        var archivos = respuesta.archivos;

        var tabla = document.getElementById("TablaClase");

        // Obtener la referencia al cuerpo de la tabla
        var tbody = tabla.getElementsByTagName("tbody")[0];
        while (tbody.firstChild) {
            tbody.removeChild(tbody.firstChild);
        }
        // Llenar la tabla con los datos
        for (var i = 0; i < archivos.length; i++) {
            // Crear una nueva fila
            var fila = tbody.insertRow(i);

            //BTN BORRAR
            var boton = document.createElement("button");
            boton.type = "button";
            boton.className = "btn btn-icon btn-round btn-danger";
            var icono = document.createElement("i");
            icono.className = "fa fa-trash";

            if (i === archivos.length - 1) {
                boton.disabled = true;
            }

            (function (indice) {
                boton.onclick = function () {
                    borrarArchivo(
                        carpeta +
                            "/CLASES MODELO/" +
                            archivos[indice].nombre +
                            "." +
                            archivos[indice].extension,
                        rutaBorrar
                    );
                };
            })(i);

            boton.appendChild(icono);

            //BTN ABRIR
            var enlace = document.createElement("a");
            enlace.type = "button";
            enlace.className = "btn btn-default btn-round";
            enlace.innerText = "ABRIR";
            enlace.href =
                direccion +
                "/" +
                carpeta +
                "/CLASES MODELO/" +
                archivos[i].nombre +
                "." +
                archivos[i].extension; // Aquí debes especificar la URL deseada

            // Insertar celdas en la fila
            var celda1 = fila.insertCell(0);
            var celda2 = fila.insertCell(1);

            if (permisoArchivo == 1) {
                var celda3 = fila.insertCell(2);
            }

            // Llenar las celdas con los datos
            celda1.innerHTML = archivos[i].nombre + "." + archivos[i].extension;
            celda2.appendChild(enlace);
            if (permisoArchivo == 1) {
                celda3.appendChild(boton);
            }
        }
    });
}

function HistoEvaluar(datos, ruta, direccion, rutaBorrar) {
    var datosObj = JSON.parse(datos);
    var carpeta =
        datosObj.Nombres_doc.toUpperCase() +
        " " +
        datosObj.Paterno_doc.toUpperCase() +
        " " +
        datosObj.Materno_doc.toUpperCase() +
        " " +
        datosObj.Carnet_doc;
    document.getElementById("carpeta2").value = carpeta;
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
        data: "carpeta=" + carpeta,
        processData: false,
        contentType: false,
    }).done(function (respuesta) {
        Swal.close();
        var archivos = respuesta.archivos;

        var tabla = document.getElementById("TablaEvaluar");

        // Obtener la referencia al cuerpo de la tabla
        var tbody = tabla.getElementsByTagName("tbody")[0];
        while (tbody.firstChild) {
            tbody.removeChild(tbody.firstChild);
        }
        // Llenar la tabla con los datos
        for (var i = 0; i < archivos.length; i++) {
            // Crear una nueva fila
            var fila = tbody.insertRow(i);

            //BTN BORRAR
            var boton = document.createElement("button");
            boton.type = "button";
            boton.className = "btn btn-icon btn-round btn-danger";
            var icono = document.createElement("i");
            icono.className = "fa fa-trash";

            if (i === archivos.length - 1) {
                boton.disabled = true;
            }

            (function (indice) {
                boton.onclick = function () {
                    borrarArchivo(
                        carpeta +
                            "/RESPALDOS DE EVALUAR/" +
                            archivos[indice].nombre +
                            "." +
                            archivos[indice].extension,
                        rutaBorrar
                    );
                };
            })(i);

            boton.appendChild(icono);

            //BTN ABRIR
            var enlace = document.createElement("a");
            enlace.type = "button";
            enlace.className = "btn btn-default btn-round";
            enlace.innerText = "ABRIR";
            enlace.href =
                direccion +
                "/" +
                carpeta +
                "/RESPALDOS DE EVALUAR/" +
                archivos[i].nombre +
                "." +
                archivos[i].extension; // Aquí debes especificar la URL deseada

            // Insertar celdas en la fila
            var celda1 = fila.insertCell(0);
            var celda2 = fila.insertCell(1);
            if (permisoArchivo == 1) {
                var celda3 = fila.insertCell(2);
            }

            // Llenar las celdas con los datos
            celda1.innerHTML = archivos[i].nombre + "." + archivos[i].extension;
            celda2.appendChild(enlace);
            if (permisoArchivo == 1) {
                celda3.appendChild(boton);
            }
        }
    });
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
                            location.reload();
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
