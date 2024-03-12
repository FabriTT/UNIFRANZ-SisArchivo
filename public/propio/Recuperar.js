function Correo(ruta) {
    var contenedor = document.getElementById("divError");
    var mensaje = document.getElementById("error");
    var email = document.getElementById("email");
    var validado = true;

    validado = validado && validarVacio(email, contenedor, mensaje);

    if (validado) {
        Swal.fire({
            title: "Cargando...",
            allowOutsideClick: false,
            showConfirmButton: false,
            onBeforeOpen: () => {
                Swal.showLoading();
            },
        });
        var data = $("#frm_login").serialize();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: "POST",
            url: ruta,
            data: data,
            success: function (response) {
                Swal.hideLoading();
                if (response == "ok") {
                    Swal.fire({
                        title: "¡Correo verificado!",
                        text: "Se envio un codigo de recuperacion a su correo electronico.",
                        icon: "success",
                        confirmButtonText: "OK",
                    });
                    document.getElementById("divCodigo").style.display =
                        "block";
                    document.getElementById("btnCorreo").style.display = "none";
                    document.getElementById("btnCodigo").style.display =
                        "block";
                    document.getElementById("email").readOnly = true;
                    var miDiv = document.getElementById("divEmail");
                    var elementos = miDiv.getElementsByTagName("*");
                    for (var i = 0; i < elementos.length; i++) {
                        if (elementos[i].id !== "email") {
                            elementos[i].disabled = true;
                        }
                    }
                } else {
                    Swal.fire({
                        title: "¡Error!",
                        text: "No se encontro el registro de su cuenta.",
                        icon: "error",
                        confirmButtonText: "OK",
                    });
                }
            },
        });
    }
}

function Codigo(ruta) {
    var contenedor = document.getElementById("divError");
    var mensaje = document.getElementById("error");
    var codigo = document.getElementById("codigo");
    var validado = true;

    validado = validado && validarVacio(codigo, contenedor, mensaje);

    if (validado) {
        var data = $("#frm_login").serialize();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: "POST",
            url: ruta,
            data: data,
            success: function (response) {
                if (response == "ok") {
                    Swal.fire({
                        title: "¡Codigo verificado!",
                        text: "Se verifico el codigo exitosamente.",
                        icon: "success",
                        confirmButtonText: "OK",
                    });
                    document.getElementById("divContra").style.display =
                        "block";
                    document.getElementById("divContra2").style.display =
                        "block";
                    document.getElementById("btnCodigo").style.display = "none";
                    document.getElementById("btnContra").style.display =
                        "block";
                    document.getElementById("codigo").readOnly = true;
                    var miDiv = document.getElementById("divCodigo");
                    var elementos = miDiv.getElementsByTagName("*");
                    for (var i = 0; i < elementos.length; i++) {
                        elementos[i].disabled = true;
                    }
                } else {
                    Swal.fire({
                        title: "¡Error!",
                        text: "El codigo ingresado es incorrecto.",
                        icon: "error",
                        confirmButtonText: "OK",
                    });
                }
            },
        });
    }
}

function Actualizar(ruta) {
    var contenedor = document.getElementById("divError");
    var mensaje = document.getElementById("error");
    var password = document.getElementById("pass");
    var confirmacion = document.getElementById("pass2");
    var validado = true;

    validado = validado && validarVacio(password, contenedor, mensaje);
    validado = validado && validarVacio(codigo, confirmacion, mensaje);
    //validar iguales
    validado =
        validado && validarIguales(password, confirmacion, contenedor, mensaje);

    //contraseña segura
    validado = validado && validarContraseña(password, contenedor, mensaje);
    validado = validado && validarContraseña(confirmacion, contenedor, mensaje);

    if (validado) {
        Swal.fire({
            title: "Cargando...",
            allowOutsideClick: false,
            showConfirmButton: false,
            onBeforeOpen: () => {
                Swal.showLoading();
            },
        });

        var data = $("#frm_login").serialize();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: "POST",
            url: ruta,
            data: data,
            success: function (response) {
                Swal.close();
                if (response == "ok") {
                    Swal.fire({
                        title: "¡Registro exitoso!",
                        text: "Se actualizo exitosamente la contraseña.",
                        icon: "success",
                        confirmButtonText: "OK",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.replace("/");
                        }
                    });
                } else {
                    Swal.fire({
                        title: "¡Error!",
                        text: "El codigo ingresado es incorrecto." + response,
                        icon: "error",
                        confirmButtonText: "OK",
                    });
                }
            },
        });
    }
}

function Ver() {
    var passwordInput = document.getElementById("pass");
    var toggleBtn = document.getElementById("icon");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleBtn.innerHTML =
            '<i class="fa fa-eye-slash" aria-hidden="true"></i>';
    } else {
        passwordInput.type = "password";
        toggleBtn.innerHTML = '<i class="fa fa-eye" aria-hidden="true"></i>';
    }
}

function Ver2() {
    var passwordInput = document.getElementById("pass2");
    var toggleBtn = document.getElementById("icon2");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleBtn.innerHTML =
            '<i class="fa fa-eye-slash" aria-hidden="true"></i>';
    } else {
        passwordInput.type = "password";
        toggleBtn.innerHTML = '<i class="fa fa-eye" aria-hidden="true"></i>';
    }
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
