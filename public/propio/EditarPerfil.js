const file = document.getElementById("foto");
const img = document.getElementById("imagen");
file.addEventListener("change", (e) => {
    if (e.target.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            img.src = e.target.result;
        };
        reader.readAsDataURL(e.target.files[0]);
    } else {
        img.src = defaultfile;
    }
});

function Guardar(ruta, ruta2) {
    var contenedor = document.getElementById("divErrorGuardar");
    var mensaje = document.getElementById("errorGuardar");
    var nombres = document.getElementById("nombres");
    var paterno = document.getElementById("paterno");
    var materno = document.getElementById("materno");
    var carnet = document.getElementById("carnet");
    var correoPersonal = document.getElementById("correo");
    var telefono = document.getElementById("telefono");
    var contraseña = document.getElementById("contraseña");
    var confirmar = document.getElementById("confirmar");
    var validado = true;

    //Validar Vacios
    validado = validado && validarVacio(nombres, contenedor, mensaje);
    validado = validado && validarVacio(paterno, contenedor, mensaje);
    validado = validado && validarVacio(materno, contenedor, mensaje);
    validado = validado && validarVacio(carnet, contenedor, mensaje);
    validado = validado && validarVacio(telefono, contenedor, mensaje);
    validado = validado && validarVacio(correo, contenedor, mensaje);

    //validar lertas
    validado = validado && validarLetras(nombres, contenedor, mensaje);
    validado = validado && validarLetras(paterno, contenedor, mensaje);
    validado = validado && validarLetras(materno, contenedor, mensaje);

    //validar numeros
    validado = validado && validarCarnet(carnet, contenedor, mensaje);
    validado = validado && validarNumeros(telefono, contenedor, mensaje);

    //validar correo
    validado = validado && validarCorreo(correoPersonal, contenedor, mensaje);

    //validar iguales
    if (
        contraseña.value !== null &&
        contraseña.value !== undefined &&
        contraseña.value !== ""
    ) {
        validado =
            validado &&
            validarIguales(contraseña, confirmar, contenedor, mensaje);
    }

    //contraseña segura
    if (
        contraseña.value !== null &&
        contraseña.value !== undefined &&
        contraseña.value !== ""
    ) {
        validado =
            validado && validarContraseña(contraseña, contenedor, mensaje);
    }

    if (
        confirmar.value !== null &&
        confirmar.value !== undefined &&
        confirmar.value !== ""
    ) {
        validado =
            validado && validarContraseña(confirmar, contenedor, mensaje);
    }

    var form = document.getElementById("form-editar");
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
