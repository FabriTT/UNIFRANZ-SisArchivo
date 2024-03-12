function login() {
    var contenedor = document.getElementById("divError");
    var mensaje = document.getElementById("error");
    var email = document.getElementById("email");
    var password = document.getElementById("pass");
    var validado = true;
    validado = validado && validarVacio(email, contenedor, mensaje);
    validado = validado && validarVacio(password, contenedor, mensaje);

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
            url: "/check",
            data: data,
            success: function (response) {
                Swal.close();
                if (response == 1) {
                    Swal.fire({
                        title: "¡Inicio de sesion exitoso!",
                        text: "Bienvenido de nuevo.",
                        icon: "success",
                        confirmButtonText: "Comenzar",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.replace("/sis/dashboard");
                        }
                    });
                } else if (response == 3) {
                    Swal.fire({
                        title: "¡Error!",
                        text: "Inicio de sesión fallido. Por favor, verifica tus credenciales.",
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
    var toggleBtn = document.querySelector(".toggle-password");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleBtn.innerHTML =
            '<i class="fa fa-eye-slash" aria-hidden="true"></i>';
    } else {
        passwordInput.type = "password";
        toggleBtn.innerHTML = '<i class="fa fa-eye" aria-hidden="true"></i>';
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
