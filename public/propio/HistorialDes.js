function Desactivar(ruta, ruta2) {
    var contenedor = document.getElementById("divErrorDesactivar");
    var mensaje = document.getElementById("errorDesactivar");
    var motivo = document.getElementById("motivo");
    var clasificacion = document.getElementsByName("clasificacion");
    var div = document.getElementById("divClasificacion");
    var id = document.getElementById("idDesactivacion");
    var validado = true;

    //Validar Vacios
    validado = validado && validarVacioHistorial(motivo, contenedor, mensaje);
    validado =
        validado &&
        validarVacioRadioHistorial(clasificacion, div, contenedor, mensaje);

    //validar lertas
    //validado = validado && validarLetras(nombres, contenedor, mensaje);

    var form = document.getElementById("form-desactivar");
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
                        title: "Desactivacion exitosa!",
                        text: "Almacenado en la base de datos.",
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
                        text: "Error al guardar en la base de datos",
                        icon: "error",
                        confirmButtonText: "OK",
                    });
                }
            },
        });
    }
}

function HistorialDesactivacion(id, ruta) {
    document.getElementById("idDesactivacion").value = id;
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    Swal.fire({
        title: "Cargando...",
        allowOutsideClick: false,
        showConfirmButton: false,
        onBeforeOpen: () => {
            Swal.showLoading();
        },
    });
    $.ajax({
        url: ruta,
        type: "GET",
        data: "id=" + id,
        processData: false,
        contentType: false,
    }).done(function (respuesta) {
        Swal.close();
        var historiales = respuesta.historiales;

        var tabla = document.getElementById("TablaDesactivacion");

        // Obtener la referencia al cuerpo de la tabla
        var tbody = tabla.getElementsByTagName("tbody")[0];
        while (tbody.firstChild) {
            tbody.removeChild(tbody.firstChild);
        }
        // Llenar la tabla con los datos
        for (var i = 0; i < historiales.length; i++) {
            // Crear una nueva fila
            var fila = tbody.insertRow(i);

            var dato = document.createElement("span");
            dato.className = "badge bg-success";
            dato.innerText = "BUEN MOTIVO";

            var dato1 = document.createElement("span");
            dato1.className = "badge bg-warning";
            dato1.innerText = "REGULAR MOTIVO";

            var dato2 = document.createElement("span");
            dato2.className = "badge bg-danger";
            dato2.innerText = "MAL MOTIVO";

            // Insertar celdas en la fila
            var celda1 = fila.insertCell(0);
            var celda2 = fila.insertCell(1);

            //var celda3 = fila.insertCell(2);

            // Llenar las celdas con los datos
            celda1.innerHTML = historiales[i].Motivo_des;
            if (historiales[i].Clasificacion_des == "BUENO") {
                celda2.appendChild(dato);
            } else if (historiales[i].Clasificacion_des == "REGULAR") {
                celda2.appendChild(dato1);
            } else if (historiales[i].Clasificacion_des == "MALO") {
                celda2.appendChild(dato2);
            }
        }
    });
}

function validarVacioHistorial(input, contenedor, mensaje) {
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

function validarVacioRadioHistorial(input, div, contenedor, mensaje) {
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
                                location.reload();
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
