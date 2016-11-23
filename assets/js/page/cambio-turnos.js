/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 * carga guardias del panel izquierdo
 */
var codturno;
var codemp;
var codturno2;
var codemp2;

function seleccionarL(elemento, turno, empleado){
    $(elemento).addClass('info').siblings().removeClass('info');
    codturno = turno;
    codemp = empleado;
}

function seleccionarR(elemento, turno, empleado){
    $(elemento).addClass('info').siblings().removeClass('info');
    codturno2 = turno;
    codemp2 = empleado;
}

function cargarGuardiasL(){
    var fecha = $('#fecha-origen').val();
    var dependencia = $('#dependencia').val();
    
    var url="index.php?page=cambioturnos&accion=cargarcboguardias"
    $.ajax({
        type: "POST",
        url:url,
        data:{
            fecha:fecha,
            dependencia:dependencia
        },
        success: function(datos){      
            $('#cbo_guardiasL').html(datos);
        }
    });
}

/*
 * carga guardias del panel derecho
 */
function cargarGuardiasR(){
    var fecha = $('#fecha-destino').val();
    var dependencia = $('#dependencia').val();
    
    var url="index.php?page=cambioturnos&accion=cargarcboguardias"
    $.ajax({   
        type: "POST",
        url:url,
        data:{
            fecha:fecha,
            dependencia:dependencia
        },
        success: function(datos){       
            $('#cbo_guardiasR').html(datos);
        }
    });
}

function cargardetallesL(){
    var codigo = $('#cbo_guardiasL').val();
    
    var url="index.php?page=cambioturnos&accion=cargardetallesL"
    $.ajax({
        type: "POST",
        url:url,
        data:{
            codigo:codigo
        },
        success: function(datos){    
            $('#personal_guardiasL').html(datos);
        }
    });
}

function cargardetallesR(){
    var codigo = $('#cbo_guardiasR').val();
    
    var url="index.php?page=cambioturnos&accion=cargardetallesR"
    $.ajax({
        type: "POST",
        url:url,
        data:{
            codigo:codigo
        },
        success: function(datos){
            $('#personal_guardiasR').html(datos);
        }
    });
}

/*
 * evento boton registrar
 * 
 */

function insertarCambio(){
    var doc = $('#doc').val();
    var dep = $('select[name=dependencia]').val();
    var fecha = $('#fecha').val();
    var motivo = $('#motivo').val();
    var url="index.php?page=cambioturnos&accion=insertar"
    $.ajax({
        type: "POST",
        url:url,
        data:{
            doc:doc,
            fecha:fecha,
            empleados:codemp,
            turno:codturno,
            empleados2:codemp2,
            turno2:codturno2,
            motivo:motivo
        },
        success: function(datos){
            $('#mensajes').html(datos);
        }
    });
}