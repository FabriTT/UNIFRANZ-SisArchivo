document.addEventListener("DOMContentLoaded", function () {
    SelectBanco();
});

jQuery(document).ready(function () {
    // Recuperar las variables de localStorage
    var showModal = localStorage.getItem("Modal");
    var Nombre = localStorage.getItem("Nombre");
    var Carnet = localStorage.getItem("Carnet");
    if (showModal === "1") {
        // Asegúrate de que el modal esté cargado antes de intentar mostrarlo
        if (jQuery("#Banco").length > 0) {
            // Abre el modal
            jQuery("#Banco").modal("show");

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
                jQuery("#Modprofesion").val(docente[0].NumeroCuenta_doc);
                jQuery("#Modfechatitulo").val(docente[0].Banco_doc);
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
    document.getElementById("Modcuenta").value = datosObj.NumeroCuenta_doc;
    document.getElementById("Modbanco").value = datosObj.Id_ban;
    var factura = datosObj.Factura_doc;
    if (factura === 1) {
        document.getElementById("facturaSi").checked = true;
    } else if (factura === 0) {
        document.getElementById("facturaNo").checked = true;
    } else if (factura === null) {
        document.getElementById("facturaNo").checked = false;
        document.getElementById("facturaSi").checked = false;
    }
}

function Modificar(ruta, ruta2, ruta3) {
    var contenedor = document.getElementById("divErrorModificar");
    var mensaje = document.getElementById("errorModificar");

    var nombre = document.getElementById("Modnombre");
    var carnet = document.getElementById("Modcarnet");

    var numeroCuenta = document.getElementById("Modcuenta");
    var banco = document.getElementById("Modbanco");
    var fotocuenta = document.getElementById("Modfotobanco");
    var factura = document.getElementsByName("factura");
    var div = document.getElementById("divFactura");
    var validado = true;

    //Validar Vacios
    validado = validado && validarVacio(numeroCuenta, contenedor, mensaje);
    validado = validado && validarVacio(banco, contenedor, mensaje);
    validado = validado && validarVacio(fotocuenta, contenedor, mensaje);
    validado = validado && validarVacioRadio(factura, div, contenedor, mensaje);

    //validar numeros
    validado = validado && validarNumeros(numeroCuenta, contenedor, mensaje);

    //validar archivos
    validado = validado && validarArchivos(fotocuenta, contenedor, mensaje);

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
                        text:
                            "Error al guardar en la base de datos: " + response,
                        icon: "error",
                        confirmButtonText: "OK",
                    });
                }
            },
        });
    }
}

function InsertarBanco(ruta) {
    var contenedor = document.getElementById("divErrorBan");
    var mensaje = document.getElementById("errorBan");

    var banco = document.getElementById("banco");
    var validado = true;

    //Validar Vacios
    validado = validado && validarVacio(banco, contenedor, mensaje);

    var form = document.getElementById("form-banco");
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
                            banco.value = "";
                            MostrarBancos();
                            SelectBanco();
                        }
                    });
                } else {
                    Swal.fire({
                        title: "¡Error!",
                        text:
                            "Error al guardar en la base de datos: " + response,
                        icon: "error",
                        confirmButtonText: "OK",
                    });
                }
            },
        });
    }
}

function borrarBanco(id) {
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
                url: eliminarBanco,
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
                            MostrarBancos();
                            SelectBanco();
                        }
                    });
                } else {
                    Swal.fire({
                        title: "¡Error!",
                        text:
                            "Error al guardar en la base de datos: " + response,
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

function HistoCuenta(datos, ruta, direccion, rutaBorrar) {
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

        var tabla = document.getElementById("TablaCuenta");

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
                            "/CUENTAS BANCARIAS/" +
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
                "/CUENTAS BANCARIAS/" +
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

function MostrarBancos() {
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
        url: bancos,
        type: "GET",
        processData: false,
        contentType: false,
    }).done(function (respuesta) {
        Swal.close();
        var bancos = respuesta.bancos;

        var tabla = document.getElementById("TablaBanco");

        // Obtener la referencia al cuerpo de la tabla
        var tbody = tabla.getElementsByTagName("tbody")[0];
        while (tbody.firstChild) {
            tbody.removeChild(tbody.firstChild);
        }
        // Llenar la tabla con los datos
        for (var i = 0; i < bancos.length; i++) {
            // Crear una nueva fila
            var fila = tbody.insertRow(i);

            var boton = document.createElement("button");
            boton.type = "button";
            boton.className = "btn btn-icon btn-round btn-danger";
            var icono = document.createElement("i");
            icono.className = "fa fa-trash";
            (function (indice) {
                boton.onclick = function () {
                    borrarBanco(bancos[indice].Id_ban);
                };
            })(i);
            boton.appendChild(icono);

            // Insertar celdas en la fila
            var celda1 = fila.insertCell(0);
            if (permisoBorrarBanco == 1) {
                var celda2 = fila.insertCell(1);
            }

            // Llenar las celdas con los datos
            celda1.innerHTML = bancos[i].Nombre_ban;
            if (permisoBorrarBanco == 1) {
                celda2.appendChild(boton);
            }
        }
    });
}

function SelectBanco() {
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
        url: bancos,
        type: "GET",
        processData: false,
        contentType: false,
    }).done(function (respuesta) {
        Swal.close();
        var bancos = respuesta.bancos;
        var select = document.getElementById("Modbanco");

        select.innerHTML = "";

        var opcionInicial = document.createElement("option");
        opcionInicial.value = "";
        opcionInicial.text = "";
        opcionInicial.disabled = true;
        opcionInicial.selected = true;

        select.add(opcionInicial);

        // Llenar la tabla con los datos
        for (var i = 0; i < bancos.length; i++) {
            var nuevaOpcion = document.createElement("option");
            // Configurar el valor y texto de la nueva opción
            nuevaOpcion.value = bancos[i].Id_ban;
            nuevaOpcion.text = bancos[i].Nombre_ban;

            // Agregar la nueva opción al final del select

            select.add(nuevaOpcion);
        }
    });
}

function MostrarFacturacion(id, nombre) {
    document.getElementById("docente").value = nombre;
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
        url: facturacion,
        type: "GET",
        data: "id=" + id,
        processData: false,
        contentType: false,
    }).done(function (respuesta) {
        Swal.close();
        var facturas = respuesta.facturas;

        var tabla = document.getElementById("TablaFactura");

        // Obtener la referencia al cuerpo de la tabla
        var tbody = tabla.getElementsByTagName("tbody")[0];
        while (tbody.firstChild) {
            tbody.removeChild(tbody.firstChild);
        }
        // Llenar la tabla con los datos
        for (var i = 0; i < facturas.length; i++) {
            // Crear una nueva fila
            var fila = tbody.insertRow(i);

            var dato = document.createElement("span");
            dato.className = "badge bg-success";
            dato.innerText = "facturo";

            var dato1 = document.createElement("span");
            dato1.className = "badge bg-danger";
            dato1.innerText = "no facturo";

            // Insertar celdas en la fila
            var celda1 = fila.insertCell(0);
            var celda2 = fila.insertCell(1);
            var celda3 = fila.insertCell(2);

            // Llenar las celdas con los datos
            celda1.innerHTML = facturas[i].FechaInicio_hfac;
            celda2.innerHTML = facturas[i].FechaFin_hfac;
            if (facturas[i].Estado_hfac == 1) {
                celda3.appendChild(dato);
            } else if (facturas[i].Estado_hfac == 0) {
                celda3.appendChild(dato1);
            }
        }
    });
}
