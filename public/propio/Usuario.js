function Guardar(ruta, ruta2) {
    var contenedor = document.getElementById("divErrorGuardar");
    var mensaje = document.getElementById("errorGuardar");
    var nombres = document.getElementById("nombres");
    var paterno = document.getElementById("paterno");
    var materno = document.getElementById("materno");
    var carnet = document.getElementById("carnet");
    var correoPersonal = document.getElementById("correo");
    var celular = document.getElementById("celular");
    var contraseña = document.getElementById("contraseña");
    var confirmar = document.getElementById("confirmar");
    var rol = document.getElementsByName("rol");
    var div = document.getElementById("divRadio");
    var validado = true;

    //Validar Vacios
    validado = validado && validarVacio(nombres, contenedor, mensaje);
    validado = validado && validarVacio(paterno, contenedor, mensaje);
    validado = validado && validarVacio(materno, contenedor, mensaje);
    validado = validado && validarVacio(carnet, contenedor, mensaje);
    validado = validado && validarVacio(celular, contenedor, mensaje);
    validado = validado && validarVacio(correo, contenedor, mensaje);
    validado = validado && validarVacio(contraseña, contenedor, mensaje);
    validado = validado && validarVacio(confirmar, contenedor, mensaje);
    validado = validado && validarVacioRadio(rol, div, contenedor, mensaje);

    //validar lertas
    validado = validado && validarLetras(nombres, contenedor, mensaje);
    validado = validado && validarLetras(paterno, contenedor, mensaje);
    validado = validado && validarLetras(materno, contenedor, mensaje);

    //validar numeros
    validado = validado && validarCarnet(carnet, contenedor, mensaje);
    validado = validado && validarNumeros(celular, contenedor, mensaje);

    //validar correo
    validado = validado && validarCorreo(correoPersonal, contenedor, mensaje);

    //validar iguales
    validado =
        validado && validarIguales(contraseña, confirmar, contenedor, mensaje);

    //contraseña segura
    validado = validado && validarContraseña(contraseña, contenedor, mensaje);
    validado = validado && validarContraseña(confirmar, contenedor, mensaje);

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
                        confirmButtonText: "Continuar",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.replace(ruta2);
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

function desactivar(ruta, ruta2) {
    Swal.fire({
        title: "Estas seguro de desactivar el registro?",
        showDenyButton: true,
        confirmButtonText: "Aceptar",
        denyButtonText: `Cancelar`,
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
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });

            $.ajax({
                type: "GET",
                url: ruta,
                success: function (response) {
                    Swal.close();
                    if (response == "ok") {
                        Swal.fire({
                            title: "¡Registro desactivado!",
                            text: "Registro desactivado en la base de datos.",
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
                            text: "Error al guardar en la base de datos",
                            icon: "error",
                            confirmButtonText: "OK",
                        });
                    }
                },
            });
        } else if (result.isDenied) {
            Swal.fire("Cancelado", "", "info");
        }
    });
}

function activar(ruta, ruta2) {
    Swal.fire({
        title: "Estas seguro de activar el registro?",
        showDenyButton: true,
        confirmButtonText: "Aceptar",
        denyButtonText: `Cancelar`,
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
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });

            $.ajax({
                type: "GET",
                url: ruta,
                success: function (response) {
                    Swal.close();
                    if (response == "ok") {
                        Swal.fire({
                            title: "¡Registro activado!",
                            text: "Registro activado en la base de datos.",
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
                            text: "Error al guardar en la base de datos: ",
                            icon: "error",
                            confirmButtonText: "OK",
                        });
                    }
                },
            });
        } else if (result.isDenied) {
            Swal.fire("Cancelado", "", "info");
        }
    });
}

function Modificar(ruta, ruta2) {
    var contenedor = document.getElementById("divErrorModificar");
    var mensaje = document.getElementById("errorModificar");
    var rol = document.getElementsByName("Modrol");
    var div = document.getElementById("ModdivRadio");
    var validado = true;

    //Validar Vacios
    validado = validado && validarVacioRadio(rol, div, contenedor, mensaje);

    var form = document.getElementById("form-modificar");
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

function validarVacioRadio(input, div, contenedor, mensaje) {
    if (input[0].checked || input[1].checked || input[2].checked) {
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
    fechaLimiteInferior.setFullYear(fechaLimiteInferior.getFullYear() - 60);

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
    var fechaSeleccionada = new Date(input.value);
    var fechaMinima = new Date();
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

function mostrarContrasena() {
    var campoContrasena = document.getElementById("contraseña");
    var checkboxMostrar = document.getElementById("check1");

    campoContrasena.type = checkboxMostrar.checked ? "text" : "password";
}

function mostrarConfirmar() {
    var campoContrasena = document.getElementById("confirmar");
    var checkboxMostrar = document.getElementById("check2");

    campoContrasena.type = checkboxMostrar.checked ? "text" : "password";
}

function validarIguales(input, input2, contenedor, mensaje) {
    if (input.value == input2.value) {
        input.style.borderColor = "black";
        contenedor.style.borderColor = "white";
        mensaje.innerHTML = "";
        return true;
    } else {
        input.style.borderColor = "red";
        input2.style.borderColor = "red";
        contenedor.style.borderColor = "red";
        mensaje.innerHTML = "No coinciden las contraseñas";
        return false;
    }
}

function validarContraseña(input, contenedor, mensaje) {
    var expresion =
        /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    if (!expresion.test(input.value)) {
        input.style.borderColor = "red";
        contenedor.style.borderColor = "red";
        mensaje.innerHTML =
            "La contraseña debe tener el siguiente formato:<br> -Al menos una letra minuscula.<br>-Al menos una letra mayuscula.<br>-Al menos un numero.<br>-Al menos un caracter especial  (@, $, !, %, *, ?, o &).<br>-Una longitud minima de 8 caracteres.<br>";
        return false;
    } else {
        input.style.borderColor = "black";
        contenedor.style.borderColor = "white";
        mensaje.innerHTML = "";
        return true;
    }
}

function seleccionar(datos) {
    var datosObj = JSON.parse(datos);

    document.getElementById("Modnombre").value =
        datosObj.name + " " + datosObj.paterno + " " + datosObj.materno;
    document.getElementById("Modcarnet").value = datosObj.carnet;
    document.getElementById("Modcelular").value = datosObj.telefono;
    document.getElementById("Modcorreo").value = datosObj.email;
    var rol = datosObj.rol;
    if (rol === "Administrador") {
        document.getElementById("Modrol1").checked = true;
    } else if (rol === "Escritor") {
        document.getElementById("Modrol2").checked = true;
    } else if (rol === "Lector") {
        document.getElementById("Modrol3").checked = true;
    }
    document.getElementById("id").value = datosObj.id;
}
