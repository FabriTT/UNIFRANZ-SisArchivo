var cargo = document.getElementById("oculto").innerHTML;
console.log(cargo);
console.log("hola");

var botonUsuarios = document.getElementById("btnUsuario");
var botonEmpleados = document.getElementById("btnEmpleado");
var botonClientes = document.getElementById("btnCliente");
var botonActas = document.getElementById("btnActa");
var botonNichos = document.getElementById("btnNichos");
var botonAlquiler = document.getElementById("btnAlquiler");
var botonMisas = document.getElementById("btnMisas");
var botonTraslados = document.getElementById("btnTraslados");
var botonCremaciones = document.getElementById("btnCremaciones");
var botonRenovaciones = document.getElementById("btnRenovaciones");
var botonBackups = document.getElementById("btnBackup");
var botonAuditoria = document.getElementById("btnAuditoria");

var titulo1 = document.getElementById("area1");
var titulo2 = document.getElementById("area2");
var titulo3 = document.getElementById("area3");
var titulo4 = document.getElementById("area4");



if(cargo=='AUSE'){
     botonUsuarios.style.display = "block";
     botonEmpleados.style.display = "block";
     botonClientes.style.display = "block";
     botonActas.style.display = "none";
     botonNichos.style.display = "none";
     botonAlquiler.style.display = "none";
     botonMisas.style.display = "none"; 
     botonTraslados.style.display = "none";
     botonCremaciones.style.display = "none";
     botonRenovaciones.style.display = "none";
     botonBackups.style.display = "none";
     botonAuditoria.style.display = "none";
    botonTraslados.style.display = "none";
    botonCremaciones.style.display = "none";
    botonRenovaciones.style.display = "none";
    botonBackups.style.display = "none";
    botonAuditoria.style.display = "none";
     titulo1.style.display="block";
     titulo2.style.display="none";
     titulo3.style.display="none";
     titulo4.style.display="none";
    

}else if(cargo=='ADCG'){
    botonUsuarios.style.display = "none";
    botonEmpleados.style.display = "none";
    botonClientes.style.display = "none";
    botonActas.style.display = "block";
    botonNichos.style.display = "block";
    botonAlquiler.style.display = "none";
    botonMisas.style.display = "none"; 
    botonTraslados.style.display = "none";
    botonCremaciones.style.display = "none";
    botonRenovaciones.style.display = "none";
    botonBackups.style.display = "none";
    botonAuditoria.style.display = "none";

    botonTraslados.style.display = "none";
    botonCremaciones.style.display = "none";
    botonRenovaciones.style.display = "none";
    botonBackups.style.display = "none";
    botonAuditoria.style.display = "none";

    titulo1.style.display="none";
    titulo2.style.display="block";
    titulo3.style.display="none";
    titulo4.style.display="none";

}else if(cargo=='AVEN'){
    botonUsuarios.style.display = "none";
    botonEmpleados.style.display = "none";
    botonClientes.style.display = "none";
    botonActas.style.display = "none";
    botonNichos.style.display = "none";
    botonAlquiler.style.display = "block";
    botonMisas.style.display = "block"; 
    botonTraslados.style.display = "block";
    botonCremaciones.style.display = "block";
    botonRenovaciones.style.display = "block";
    botonBackups.style.display = "none";
    botonAuditoria.style.display = "none";

    botonTraslados.style.display = "none";
    botonCremaciones.style.display = "none";
    botonRenovaciones.style.display = "none";
    botonBackups.style.display = "none";
    botonAuditoria.style.display = "none";

    titulo1.style.display="none";
    titulo2.style.display="none";
    titulo3.style.display="block";
    titulo4.style.display="none";
    

}else if(cargo=='ASEG'){
    botonUsuarios.style.display = "none";
    botonEmpleados.style.display = "none";
    botonClientes.style.display = "none";
    botonActas.style.display = "none";
    botonNichos.style.display = "none";
    botonAlquiler.style.display = "none";
    botonMisas.style.display = "none"; 
    botonTraslados.style.display = "none";
    botonCremaciones.style.display = "none";
    botonRenovaciones.style.display = "none";
    botonBackups.style.display = "block";
    botonAuditoria.style.display = "block";

    botonTraslados.style.display = "none";
    botonCremaciones.style.display = "none";
    botonRenovaciones.style.display = "none";
    botonBackups.style.display = "none";
    botonAuditoria.style.display = "none";

    titulo1.style.display="none";
    titulo2.style.display="none";
    titulo3.style.display="none";
    titulo4.style.display="block";
    
}