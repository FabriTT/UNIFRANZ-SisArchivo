document.addEventListener("DOMContentLoaded", function () {
    SelectNacionalidad();
});

function Guardar(ruta, ruta2, ruta3) {
    var contenedor = document.getElementById("divErrorGuardar");
    var mensaje = document.getElementById("errorGuardar");
    var nombres = document.getElementById("nombres");
    var paterno = document.getElementById("paterno");
    var materno = document.getElementById("materno");
    var nacimiento = document.getElementById("nacimiento");
    var carnet = document.getElementById("carnet");
    var vencimiento = document.getElementById("vencimiento");
    var ciudadania = document.getElementById("ciudadania");
    var sexo = document.getElementsByName("sexo");
    var div = document.getElementById("divRadio");
    var direccion = document.getElementById("direccion");
    var correoPersonal = document.getElementById("correoPersonal");
    var correoCoorporativo = document.getElementById("correoCoorporativo");
    var telefono = document.getElementById("telparticular");
    var celular = document.getElementById("celular");
    var fotocarnet = document.getElementById("fotocarnet");
    var fotonacimiento = document.getElementById("fotonacimiento");
    var nombresEmergencia = document.getElementById("nombresEmergencia");
    var paternoEmergencia = document.getElementById("paternoEmergencia");
    var maternoEmergencia = document.getElementById("maternoEmergencia");
    var gradoEmergencia = document.getElementById("gradoEmergencia");
    var celularEmergencia = document.getElementById("celularEmergencia");
    var validado = true;

    //Validar Vacios
    validado = validado && validarVacio(nombres, contenedor, mensaje);
    validado = validado && validarVacio(paterno, contenedor, mensaje);
    validado = validado && validarVacio(materno, contenedor, mensaje);
    validado = validado && validarVacio(nacimiento, contenedor, mensaje);
    validado = validado && validarVacio(carnet, contenedor, mensaje);
    validado = validado && validarVacio(vencimiento, contenedor, mensaje);
    validado = validado && validarVacio(ciudadania, contenedor, mensaje);
    validado = validado && validarVacioRadio(sexo, div, contenedor, mensaje);
    validado = validado && validarVacio(direccion, contenedor, mensaje);
    validado = validado && validarVacio(correoPersonal, contenedor, mensaje);
    validado =
        validado && validarVacio(correoCoorporativo, contenedor, mensaje);
    validado = validado && validarVacio(celular, contenedor, mensaje);
    validado = validado && validarVacio(fotocarnet, contenedor, mensaje);
    validado = validado && validarVacio(fotonacimiento, contenedor, mensaje);
    validado = validado && validarVacio(nombresEmergencia, contenedor, mensaje);
    validado = validado && validarVacio(paternoEmergencia, contenedor, mensaje);
    validado = validado && validarVacio(maternoEmergencia, contenedor, mensaje);
    validado = validado && validarVacio(gradoEmergencia, contenedor, mensaje);
    validado = validado && validarVacio(celularEmergencia, contenedor, mensaje);

    //validar lertas
    validado = validado && validarLetras(nombres, contenedor, mensaje);
    validado = validado && validarLetras(paterno, contenedor, mensaje);
    validado = validado && validarLetras(materno, contenedor, mensaje);
    validado =
        validado && validarLetras(nombresEmergencia, contenedor, mensaje);
    validado =
        validado && validarLetras(paternoEmergencia, contenedor, mensaje);
    validado =
        validado && validarLetras(maternoEmergencia, contenedor, mensaje);

    //validar numeros
    validado = validado && validarCarnet(carnet, contenedor, mensaje);
    validado = validado && validarNumerosYVacio(telefono, contenedor, mensaje);
    validado = validado && validarNumeros(celular, contenedor, mensaje);
    validado =
        validado && validarNumeros(celularEmergencia, contenedor, mensaje);

    //validar correo
    validado = validado && validarCorreo(correoPersonal, contenedor, mensaje);
    validado =
        validado && validarCorreo(correoCoorporativo, contenedor, mensaje);

    //validar nacimiento
    validado = validado && validarNacimiento(nacimiento, contenedor, mensaje);

    //validar vencimiento
    validado = validado && validarVencimiento(vencimiento, contenedor, mensaje);

    //validar archivos
    validado = validado && validarArchivos(fotocarnet, contenedor, mensaje);
    validado = validado && validarArchivos(fotonacimiento, contenedor, mensaje);

    var form = document.getElementById("form-insertar");
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
                            localStorage.setItem(
                                "Nombre",
                                nombres.value +
                                    " " +
                                    paterno.value +
                                    " " +
                                    materno.value
                            );
                            localStorage.setItem("Carnet", carnet.value);
                            window.location.replace(ruta3);
                        }
                    });
                } else {
                    Swal.fire({
                        title: "¡Error!",
                        html:
                            "Error al guardar en la base de datos:<br>" +
                            response,
                        icon: "error",
                        confirmButtonText: "OK",
                    });
                }
            },
        });
    }
}

function seleccionar(datos) {
    var datosObj = JSON.parse(datos);

    document.getElementById("Modnombres").value = datosObj.Nombres_doc;
    document.getElementById("Modpaterno").value = datosObj.Paterno_doc;
    document.getElementById("Modmaterno").value = datosObj.Materno_doc;
    document.getElementById("Modnacimiento").value =
        datosObj.Fecha_Nacimiento_doc;
    document.getElementById("Modcarnet").value = datosObj.Carnet_doc;
    document.getElementById("Modvencimiento").value =
        datosObj.VencimientoCarnet_doc;
    document.getElementById("Modciudadania").value = datosObj.Id_nac;
    var sexo = datosObj.Sexo_doc;
    if (sexo === "M") {
        document.getElementById("ModsexoM").checked = true;
    } else if (sexo === "F") {
        document.getElementById("ModsexoF").checked = true;
    }
    document.getElementById("Moddireccion").value = datosObj.Direccion_doc;
    document.getElementById("ModcorreoPersonal").value =
        datosObj.CorreoPersonal_doc;
    document.getElementById("ModcorreoCoorporativo").value =
        datosObj.CorreoCoorporativo_doc;
    document.getElementById("Modtelparticular").value =
        datosObj.TelefonoParticular_doc;
    document.getElementById("Modcelular").value = datosObj.Celular_doc;
    document.getElementById("ModnombresEmergencia").value =
        datosObj.EmergenciaNombres_doc;
    document.getElementById("ModpaternoEmergencia").value =
        datosObj.EmergenciaPaterno_doc;
    document.getElementById("ModmaternoEmergencia").value =
        datosObj.EmergenciaMaterno_doc;
    document.getElementById("ModgradoEmergencia").value =
        datosObj.EmergenciaGrado_doc;
    document.getElementById("ModcelularEmergencia").value =
        datosObj.EmergenciaCelular_doc;
    document.getElementById("id").value = datosObj.Id_doc;
}

function Modificar(ruta, ruta2) {
    var contenedor = document.getElementById("divErrorModificar");
    var mensaje = document.getElementById("errorModificar");
    var nombres = document.getElementById("Modnombres");
    var paterno = document.getElementById("Modpaterno");
    var materno = document.getElementById("Modmaterno");
    var nacimiento = document.getElementById("Modnacimiento");
    var carnet = document.getElementById("Modcarnet");
    var vencimiento = document.getElementById("Modvencimiento");
    var ciudadania = document.getElementById("Modciudadania");
    var sexo = document.getElementsByName("Modsexo");
    var div = document.getElementById("ModdivRadio");
    var direccion = document.getElementById("Moddireccion");
    var correoPersonal = document.getElementById("ModcorreoPersonal");
    var correoCoorporativo = document.getElementById("ModcorreoCoorporativo");
    var telefono = document.getElementById("Modtelparticular");
    var celular = document.getElementById("Modcelular");
    var fotocarnet = document.getElementById("Modfotocarnet");
    var fotonacimiento = document.getElementById("Modfotonacimiento");
    var nombresEmergencia = document.getElementById("ModnombresEmergencia");
    var paternoEmergencia = document.getElementById("ModpaternoEmergencia");
    var maternoEmergencia = document.getElementById("ModmaternoEmergencia");
    var gradoEmergencia = document.getElementById("ModgradoEmergencia");
    var celularEmergencia = document.getElementById("ModcelularEmergencia");
    var validado = true;

    //Validar Vacios
    validado = validado && validarVacio(nombres, contenedor, mensaje);
    validado = validado && validarVacio(paterno, contenedor, mensaje);
    validado = validado && validarVacio(materno, contenedor, mensaje);
    validado = validado && validarVacio(nacimiento, contenedor, mensaje);
    validado = validado && validarVacio(carnet, contenedor, mensaje);
    validado = validado && validarVacio(vencimiento, contenedor, mensaje);
    validado = validado && validarVacio(ciudadania, contenedor, mensaje);
    validado = validado && validarVacioRadio(sexo, div, contenedor, mensaje);
    validado = validado && validarVacio(direccion, contenedor, mensaje);
    validado = validado && validarVacio(correoPersonal, contenedor, mensaje);
    validado =
        validado && validarVacio(correoCoorporativo, contenedor, mensaje);
    validado = validado && validarVacio(celular, contenedor, mensaje);
    validado = validado && validarVacio(nombresEmergencia, contenedor, mensaje);
    validado = validado && validarVacio(paternoEmergencia, contenedor, mensaje);
    validado = validado && validarVacio(maternoEmergencia, contenedor, mensaje);
    validado = validado && validarVacio(gradoEmergencia, contenedor, mensaje);
    validado = validado && validarVacio(celularEmergencia, contenedor, mensaje);

    //validar lertas
    validado = validado && validarLetras(nombres, contenedor, mensaje);
    validado = validado && validarLetras(paterno, contenedor, mensaje);
    validado = validado && validarLetras(materno, contenedor, mensaje);
    validado =
        validado && validarLetras(nombresEmergencia, contenedor, mensaje);
    validado =
        validado && validarLetras(paternoEmergencia, contenedor, mensaje);
    validado =
        validado && validarLetras(maternoEmergencia, contenedor, mensaje);

    //validar numeros
    validado = validado && validarCarnet(carnet, contenedor, mensaje);
    validado = validado && validarNumerosYVacio(telefono, contenedor, mensaje);
    validado = validado && validarNumeros(celular, contenedor, mensaje);
    validado =
        validado && validarNumeros(celularEmergencia, contenedor, mensaje);

    //validar correo
    validado = validado && validarCorreo(correoPersonal, contenedor, mensaje);
    validado =
        validado && validarCorreo(correoCoorporativo, contenedor, mensaje);

    //validar nacimiento
    validado = validado && validarNacimiento(nacimiento, contenedor, mensaje);

    //validar vencimiento
    validado = validado && validarVencimiento(vencimiento, contenedor, mensaje);

    //validar archivos
    if (
        fotocarnet !== null &&
        fotocarnet !== undefined &&
        fotocarnet.files.length > 0
    ) {
        validado = validado && validarArchivos(fotocarnet, contenedor, mensaje);
    }

    if (
        fotonacimiento !== null &&
        fotonacimiento !== undefined &&
        fotonacimiento.files.length > 0
    ) {
        validado =
            validado && validarArchivos(fotonacimiento, contenedor, mensaje);
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
        }).done(function (response) {
            Swal.close();
            if (response == "ok") {
                Swal.fire({
                    title: "Modificacion exitosa!",
                    text: "Almacenado en la base de datos.",
                    icon: "success",
                    confirmButtonText: "Continuar",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.replace(ruta2);
                    }
                });
            } else {
                Swal.fire({
                    title: "¡Error!",
                    text: "Error al guardar en la base de datos: " + response,
                    icon: "error",
                    confirmButtonText: "OK",
                });
            }
        });
    }
}

function HistoCarnet(datos, ruta, direccion, rutaBorrar) {
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
        var tabla = document.getElementById("TablaCarnet");

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
                            "/FOTOCOPIAS DE CARNET/" +
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
                "/FOTOCOPIAS DE CARNET/" +
                archivos[i].nombre +
                "." +
                archivos[i].extension; // Aquí debes especificar la URL deseada

            // Insertar celdas en la fila
            var celda1 = fila.insertCell(0);
            var celda2 = fila.insertCell(1);
            if (permisoArchivo == 1) {
                var celda3 = fila.insertCell(2);
            }
            //var celda3 = fila.insertCell(2);

            // Llenar las celdas con los datos
            celda1.innerHTML = archivos[i].nombre + "." + archivos[i].extension;
            celda2.appendChild(enlace);
            if (permisoArchivo == 1) {
                celda3.appendChild(boton);
            }
        }
    });
}

function HistoNacimiento(datos, ruta, direccion, rutaBorrar) {
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
        var tabla = document.getElementById("TablaNacimiento");

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
                            "/CERTIFICADOS DE NACIMIENTO/" +
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
                "/FOTOCOPIAS DE CARNET/" +
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

function InsertarNacionalidad(ruta) {
    var contenedor = document.getElementById("divErrorNac");
    var mensaje = document.getElementById("errorNac");

    var nacionalidad = document.getElementById("nacionalidad");
    var validado = true;

    //Validar Vacios
    validado = validado && validarVacio(nacionalidad, contenedor, mensaje);

    var form = document.getElementById("form-nacionalidad");
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
                        title: "Registro exitoso!",
                        text: "Almacenado en la base de datos.",
                        icon: "success",
                        confirmButtonText: "Continuar",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            nacionalidad.value = "";
                            MostrarNacionalidades();
                            SelectNacionalidad();
                        }
                    });
                } else {
                    Swal.fire({
                        title: "¡Error!",
                        text: "Error al guardar en la base de datos: "+response,
                        icon: "error",
                        confirmButtonText: "OK",
                    });
                }
            },
        });
    }
}

function borrarNacionalidad(id) {
    var token = $('meta[name="csrf-token"]').attr("content"); // Obtén el token CSRF
    var datos = "id=" + id + "&_token=" + token;

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
                url: eliminarNacionalidad,
                type: "POST",
                data: datos,
            }).done(function (response) {
                Swal.close();
                if (response == "ok") {
                    Swal.fire({
                        title: "Eliminacion exitosa!",
                        text: "Almacenado en la base de datos.",
                        icon: "success",
                        confirmButtonText: "Continuar",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            MostrarNacionalidades();
                            SelectNacionalidad();
                        }
                    });
                } else {
                    Swal.fire({
                        title: "¡Error!",
                        html:
                            "Error al guardar en la base de datos:<br>" +
                            response,
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

function validarVacioRadio(input, div, contenedor, mensaje) {
    if (input[0].checked || input[1].checked) {
        div.style.border = "";
        contenedor.style.borderColor = "white";
        mensaje.innerHTML = "";
        return true;
    } else {
        div.style.border = "1px solid red";
        contenedor.style.borderColor = "red";
        mensaje.innerHTML = "El campo resaltado en rojo es obligatorio";
        return false;
    }
}

function validarLetras(input, contenedor, mensaje) {
    var expresion = /^[a-zA-ZñÑ\s]*$/;
    if (!expresion.test(input.value)) {
        input.style.borderColor = "red";
        contenedor.style.borderColor = "red";
        mensaje.innerHTML =
            mensaje.innerHTML + "El campo resaltado en rojo solo acepta letras";
        return false;
    } else {
        input.style.borderColor = "black";
        contenedor.style.borderColor = "white";
        mensaje.innerHTML = "";
        return true;
    }
}

function validarNumeros(input, contenedor, mensaje) {
    var expresion = /^\d{8,}$/;
    if (!expresion.test(input.value)) {
        input.style.borderColor = "red";
        contenedor.style.borderColor = "red";
        mensaje.innerHTML =
            "El campo resaltado en rojo solo acepta numeros y un minimo de 8 digitos";
        return false;
    } else {
        input.style.borderColor = "black";
        contenedor.style.borderColor = "white";
        mensaje.innerHTML = "";
        return true;
    }
}

function validarCarnet(input, contenedor, mensaje) {
    var expresion = /^\d{6,8}$/;
    if (!expresion.test(input.value)) {
        input.style.borderColor = "red";
        contenedor.style.borderColor = "red";
        mensaje.innerHTML =
            "El campo resaltado en rojo solo acepta numeros y un minimo de 6 digitos a 8 digitos";
        return false;
    } else {
        input.style.borderColor = "black";
        contenedor.style.borderColor = "white";
        mensaje.innerHTML = "";
        return true;
    }
}

function validarNumerosYVacio(input, contenedor, mensaje) {
    var expresion = /^(|\d{7,})$/;
    if (!expresion.test(input.value)) {
        input.style.borderColor = "red";
        contenedor.style.borderColor = "red";
        mensaje.innerHTML =
            "El campo resaltado en rojo solo acepta numeros y un minimo de 7 digitos";
        return false;
    } else {
        input.style.borderColor = "black";
        contenedor.style.borderColor = "white";
        mensaje.innerHTML = "";
        return true;
    }
}

function validarCorreo(input, contenedor, mensaje) {
    var expresion = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!expresion.test(input.value)) {
        input.style.borderColor = "red";
        contenedor.style.borderColor = "red";
        mensaje.innerHTML = "La direccion de correo electronico no es valida";
        return false;
    } else {
        input.style.borderColor = "black";
        contenedor.style.borderColor = "white";
        mensaje.innerHTML = "";
        return true;
    }
}

function validarNacimiento(input, contenedor, mensaje) {
    var fechaNacimiento = new Date(input.value);
    var fechaLimiteSuperior = new Date();
    fechaLimiteSuperior.setFullYear(fechaLimiteSuperior.getFullYear() - 18);
    var fechaLimiteInferior = new Date();
    fechaLimiteInferior.setFullYear(fechaLimiteInferior.getFullYear() - 80);

    if (fechaNacimiento >= fechaLimiteSuperior) {
        input.style.borderColor = "red";
        contenedor.style.borderColor = "red";
        mensaje.innerHTML =
            "La fecha de nacimiento debe ser al menos 18 años atrás.";
        return false;
    } else if (fechaNacimiento <= fechaLimiteInferior) {
        input.style.borderColor = "red";
        contenedor.style.borderColor = "red";
        mensaje.innerHTML =
            "La fecha de nacimiento no debe ser más de 60 años atrás.";
        return false;
    } else {
        input.style.borderColor = "black";
        contenedor.style.borderColor = "white";
        mensaje.innerHTML = "";
        return true;
    }
}

function validarVencimiento(input, contenedor, mensaje) {
    var fechaSeleccionada = new Date(input.value + "T00:00:00");
    var fechaMinima = new Date();
    fechaMinima.setHours(0, 0, 0, 0);
    fechaMinima.setDate(fechaMinima.getDate() + 7);
    if (fechaSeleccionada < fechaMinima) {
        input.style.borderColor = "red";
        contenedor.style.borderColor = "red";
        mensaje.innerHTML =
            "La fecha debe ser al menos una semana después de la fecha actual.";
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

function MostrarNacionalidades() {
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
        url: nacionalidades,
        type: "GET",
        processData: false,
        contentType: false,
    }).done(function (respuesta) {
        Swal.close();
        var nacionalidades = respuesta.nacionalidades;

        var tabla = document.getElementById("TablaNacionalidad");

        // Obtener la referencia al cuerpo de la tabla
        var tbody = tabla.getElementsByTagName("tbody")[0];
        while (tbody.firstChild) {
            tbody.removeChild(tbody.firstChild);
        }
        // Llenar la tabla con los datos
        for (var i = 0; i < nacionalidades.length; i++) {
            // Crear una nueva fila
            var fila = tbody.insertRow(i);

            var boton = document.createElement("button");
            boton.type = "button";
            boton.className = "btn btn-icon btn-round btn-danger";
            var icono = document.createElement("i");
            icono.className = "fa fa-trash";
            (function (indice) {
                boton.onclick = function () {
                    borrarNacionalidad(nacionalidades[indice].Id_nac);
                };
            })(i);
            boton.appendChild(icono);

            // Insertar celdas en la fila
            var celda1 = fila.insertCell(0);

            if (permisoBorrarNacionalidad == 1) {
                var celda2 = fila.insertCell(1);
            }

            // Llenar las celdas con los datos
            celda1.innerHTML = nacionalidades[i].Nombre_nac;
            if (permisoBorrarNacionalidad == 1) {
                celda2.appendChild(boton);
            }
        }
    });
}

function SelectNacionalidad() {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: nacionalidades,
        type: "GET",
        processData: false,
        contentType: false,
    }).done(function (respuesta) {
        var nacionalidades = respuesta.nacionalidades;
        var select = document.getElementById("ciudadania");
        var select2 = document.getElementById("Modciudadania");

        select.innerHTML = "";
        select2.innerHTML = "";

        var opcionInicial = document.createElement("option");
        opcionInicial.value = "";
        opcionInicial.text = "";
        opcionInicial.disabled = true;
        opcionInicial.selected = true;

        select.add(opcionInicial);

        var opcionInicial2 = document.createElement("option");
        opcionInicial2.value = "";
        opcionInicial2.text = "";
        opcionInicial2.disabled = true;
        opcionInicial2.selected = true;

        select2.add(opcionInicial2);
        // Llenar la tabla con los datos
        for (var i = 0; i < nacionalidades.length; i++) {
            var nuevaOpcion = document.createElement("option");
            // Configurar el valor y texto de la nueva opción
            nuevaOpcion.value = nacionalidades[i].Id_nac;
            nuevaOpcion.text = nacionalidades[i].Nombre_nac;

            // Agregar la nueva opción al final del select

            select.add(nuevaOpcion);
        }

        for (var i = 0; i < nacionalidades.length; i++) {
            var nuevaOpcion2 = document.createElement("option");
            // Configurar el valor y texto de la nueva opción
            nuevaOpcion2.value = nacionalidades[i].Id_nac;
            nuevaOpcion2.text = nacionalidades[i].Nombre_nac;

            // Agregar la nueva opción al final del select
            select2.add(nuevaOpcion2);
        }
    });
}
