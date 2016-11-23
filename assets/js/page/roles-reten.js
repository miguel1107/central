
/*
 *  [ -----------------  FUNCIONES JAVASCRIPT   --------------------- ]
 */ 

 var fecha;
 var dependencia;
 var guardia;
 var empleado;
 var calendar;
 var roldeturno;
 var estadoRol = 0;

 $(document).ready(function() {
    var date = new Date();
    dependencia = $('input[name=dep_id]').val();
    

    calendar = $('#calendar').fullCalendar({
        selectable: true,
        selectHelper: true,
        events: {
            url: "controller/eventsrten.php?dep="+dependencia,
            cache: true
        },
        eventColor: '#022a50',
        /*
         * funcion para click del calendario
         */
         select: function(start, end, allDayDefault) {
            fecha = $.fullCalendar.formatDate( start, 'yyyy-MM-dd' );
            dependencia = $('input[name=dep_id]').val();
            //$('#formulario-registro').modal('show');
            $('#tituloModal').text("Registro de Roles de turno del dia2 : " + fecha);
            //cargarDatosRoles(fecha, dependencia);
            $('#detallesrolesturno').html("<div class='alert alert-info'>Seleccione un registro.</div>");
            //consultarrolxdepxtgxfecha(dependencia,guardia,fecha);
            //consultarrolxdepxtgxfechaxEmp(dependencia,guardia,fecha, empleado);
            
            /*if (event.shiftKey==1)
                //alert("La tecla shift está presionada");
            eliminarDetalles2();
            else
            //alert("La tecla shift no está presionada");
        insertarNuevoRol3();*/
    }
});
var date = $("#calendar").fullCalendar('getDate');
//var month_int = date.getMonth();    
var month_v= $('input[name=prog_mes]').val();
//var month_int = $("#prog_mes").val();
var month_int =  parseInt(month_v);
var anio = $('input[name=prog_anio]').val();
var anio_int =  parseInt(anio);
$('#calendar').fullCalendar('gotoDate',anio_int,month_int-1);
});


// cuando se activa btnagrega, se habilita la edicion//

$("#btnagregdet").click(function(){
                    //alert('clicked!');
                    btnterminar.disabled = false;
                    btnagregdet.disabled = true;
                    //$('#calendardiv').append('<p><strong>texto de prueba</strong></p>');
                    $('#calendar').remove();
                    //$('#calendardiv').append("<div id='texto'><p><strong>texto de prueba</strong></p></div>");
                    $('#calendardiv').append("<div id='calendar' ></div>");
                    $(document).ready(function() {
                        var date = new Date();
                        dependencia = $('input[name=dep_id]').val();
                        calendar = $('#calendar').fullCalendar({
                            selectable: true,
                            selectHelper: true,
                            events: {
                                url: "controller/eventsrten.php?dep="+dependencia,
                                cache: true
                            },
                            eventColor: '#022a50',
        /*
         * funcion para click del calendario
         */
         select: function(start, end, allDayDefault,event) {
            fecha = $.fullCalendar.formatDate( start, 'yyyy-MM-dd' );
            dependencia = $('input[name=dep_id]').val();
            //$('#formulario-registro').modal('show');
            $('#tituloModal').text("Registro de Roles de turno del dia2 : " + fecha);
            //cargarDatosRoles(fecha, dependencia);
            $('#detallesrolesturno').html("<div class='alert alert-info'>Seleccione un registro.</div>");
            //consultarrolxdepxtgxfecha(dependencia,guardia,fecha);
            //consultarrolxdepxtgxfechaxEmp(dependencia,guardia,fecha, empleado);
            if (event.shiftKey==1)
                //alert("La tecla shift está presionada");
            eliminarDetalles2();
            else
            //alert("La tecla shift no está presionada");
        insertarNuevoRol3();
    }
});
var date = $("#calendar").fullCalendar('getDate');
//var month_int = date.getMonth();    
var month_v= $('input[name=prog_mes]').val();
//var month_int = $("#prog_mes").val();
var month_int =  parseInt(month_v);
var anio = $('input[name=prog_anio]').val();
var anio_int =  parseInt(anio);
$('#calendar').fullCalendar('gotoDate',anio_int,month_int-1);
});
actualizarCalendario2();  
});

// cuando se activa terminar, se deshabilita la edicion//
$("#btnterminar").click(function(){
                    //alert('clicked!');
                    btnterminar.disabled = true;
                    btnagregdet.disabled = false;
                    //$('#calendardiv').append('<p><strong>texto de prueba</strong></p>');
                    $('#calendar').remove();
                    $('#calendardiv').append("<div id='calendar' ></div>");
                    $(document).ready(function() {
                        var date = new Date();
                        dependencia = $('input[name=dep_id]').val();
                        calendar = $('#calendar').fullCalendar({
                            selectable: true,
                            selectHelper: true,
                            events: {
                                url: "controller/eventsrten.php?dep="+dependencia,
                                cache: true
                            },
                            eventColor: '#022a50',
        /*
         * funcion para click del calendario
         */
         select: function(start, end, allDayDefault) {
            fecha = $.fullCalendar.formatDate( start, 'yyyy-MM-dd' );
            dependencia = $('input[name=dep_id]').val();
            //$('#formulario-registro').modal('show');
            //$('#tituloModal').text("Registro de Roles de turno del dia2 : " + fecha);
            //cargarDatosRoles(fecha, dependencia);
            //$('#detallesrolesturno').html("<div class='alert alert-info'>Seleccione un registro.</div>");
            //consultarrolxdepxtgxfecha(dependencia,guardia,fecha);
            //consultarrolxdepxtgxfechaxEmp(dependencia,guardia,fecha, empleado);
            
            /*if (event.shiftKey==1)
                //alert("La tecla shift está presionada");
            eliminarDetalles2();
            else
            //alert("La tecla shift no está presionada");
        insertarNuevoRol3();*/
    }
});
var date = $("#calendar").fullCalendar('getDate');
//var month_int = date.getMonth();    
var month_v= $('input[name=prog_mes]').val();
//var month_int = $("#prog_mes").val();
var month_int =  parseInt(month_v);
var anio = $('input[name=prog_anio]').val();
var anio_int =  parseInt(anio);
$('#calendar').fullCalendar('gotoDate',anio_int,month_int-1);
});
actualizarCalendario2();                   
});


function actualizarCalendario(){
    $("#calendar").fullCalendar('removeEventSource', "controller/eventsrten.php?dep="+dependencia);
    dependencia = $('input[name=dep_id]').val();
//    $('#calendar').fullCalendar('refetchEvents');
     // elimina eventos del calendario
    $("#calendar").fullCalendar("addEventSource", "controller/eventsrten.php?dep="+dependencia); // setea
}

function actualizarCalendario2(){
    $('.fc-corner-left').hide();
    $('.fc-corner-right').hide();
    $("#calendar").fullCalendar('removeEventSource', "controller/eventsrten.php?dep="+dependencia+"&emp="+ empleado);
    empleado = $('select[name=empleado]').val();
    dependencia = $('input[name=dep_id]').val();
    
//    $('#calendar').fullCalendar('refetchEvents');
     // elimina eventos del calendario
    $("#calendar").fullCalendar("addEventSource", "controller/eventsrten.php?dep="+dependencia+"&emp="+empleado); // setea

}


$(document).on('ready', function(){
    var Ayuda = $('#btnayuda');
    // Cuando le doy click al boton Generar Programación Envia el formulario
    Ayuda.on('click', function(e){
        e.preventDefault()


        bootbox.alert("<br/><b>AÑADIR TURNO O GUARDIA</b>: Pulsar sobre <b>Activar</b>, seleccionar GRUPO OCUPACIONAL(OPCIONAL), elegir el EMPLEADO y TIPO DE GUARDIA y luego dar <b>Clic</b> sobre el Dia que desee programar. <br/><br/><p align='justify'><b>ELIMINAR TURNO O GUARDIA</b>: Seleccionar GRUPO OCUPACIONAL, seleccionar EMPLEADO y TIPO DE GUARDIA, Mantener presionada la tecla <b>SHIFT</b>, luego dar clic sobre el Dia con la GUARDIA que corresponda.</p><br/><p align='justify'><b>Si ya no se insertaran mas roles dar clic sobre el boton DESACTIVAR</b>.</p><br/><p align='justify'>(*) Para una vista previa de su Rol General, dar clic en el enlace <b>Ver Programaci&oacute;n</b>.</p><br/><p align='right'><b>Unidad de Desarrollo. Anexo:. 1208</b></p>", function(result) {    
            if(result){
                //generar_programacion(servicio, fecha);
            }

        });
    });
});


/*
*Funcion para validar Tipo de Guardia segun Grupo Ocupacional
*/
function cargarTgxGoc() {
    var empleado= $('select[name=empleado]').val();
    var url="index.php?page=rolesreten&accion=tgxgoc"    
    $.ajax({
        type: "POST",
        url: url,
        data: {
      empleado:empleado  
        },
        success: function(datos){
            //alert(html);
            $('#guardia').html(datos);
        }
    });
}


function capturarmes() {
    var date = $("#calendar").fullCalendar('getDate');
    var month_int0 = date.getMonth(); 
    var ano_int = date.getFullYear();

    var month_int = month_int0+1;

    // $('#btnagregar').html(month_int+1);
    // $('#capturarmes').val(month_int+1);
    // alert(month_int+1);
    // alert(ano_int);

    var url="index.php?page=rolesreten&accion=oestado" 
    $.ajax({
        type: "POST",
        url: url,
        data: {
            //$empleado, $dependencia, $month_int, $ano_int
            empleado:empleado,
            dependencia:dependencia,
            month_int:month_int,
            ano_int:ano_int,

        },
        success: function(datos){
            //alert(datos);
            if (datos == 'Aprobado') {
              $('#estadoemprol').html('<label  class="alert alert-warning">Aprobado</label><br>'); 
              $('#btnagregdet').addClass('disabled'); 
          }else if (datos == 'Desaprobado')  {
            //alert('Desaprobado');
            $('#estadoemprol').html('<label  class="alert alert-warning">Sin Aprobar</label><br>');
            $('#btnagregdet').removeClass('disabled');
          }else{
            $('#estadoemprol').html('');
            $('#btnagregdet').removeClass('disabled');
          }
            

        }
    });

}


function capturarobservames() {
    var date = $("#calendar").fullCalendar('getDate');
    var month_int0 = date.getMonth(); 
    var ano_int = date.getFullYear();
    var month_int = month_int0+1;
    var url="index.php?page=rolesreten&accion=oobservacion" 
    $.ajax({
        type: "POST",
        url: url,
        data: {
            empleado:empleado,
            dependencia:dependencia,
            month_int:month_int,
            ano_int:ano_int,

        },
        success: function(datos){
            //alert(datos);
            $('#observacion').html(datos);
        }
    });

}


$(function(){

$(document).on('click','.fc-corner-right',function(){

capturarmes();capturarobservames();

    });

$(document).on('click','.fc-corner-left',function(){

capturarmes();capturarobservames();

    });


});



/*
 * filtrar lista de trabajadores por grupo
 */

 function cargarEmpleadosxGrupo(){
    var grupo = $('select[name=grupo]').val();
    var url="index.php?page=rolesreten&accion=cargaremp"
    $.ajax({   
        type: "POST",
        url:url,
        data:{
            grupo:grupo
        },
        success: function(datos){       
            $('#cboempleado').html(datos);
            $('#cboempleado').trigger("chosen:updated");
        }
    });
}


function consultarrolxdepxtgxfecha(){
    var guardia = $('select[name=guardia]').val();
    var url="index.php?page=rolesreten&accion=verificaRolxTg"
    $.ajax({   
        type: "POST",
        url:url,
        data:{
            guardia:guardia, 
            fecha:fecha,
            dependencia:dependencia
        },
        success: function(datos){       
            $('#idrol').html(datos);
        }
    });
}

/*
 * function cargarDatosRoles: carga los datos existentes sobre
 * roles
 */

 function cargarDatosRoles(fecha,dependencia){
    var url="index.php?page=rolesreten&accion=cargarroles"
    $.ajax({   
        type: "POST",
        url:url,
        data:{
            fecha:fecha,
            dependencia:dependencia,
            empleado:empleado
        },
        success: function(datos){       
            $('#rolesturno').html(datos);
        }
    });
}

function consultarrolxdepxtgxfechaxEmp(){
    var guardia = $('select[name=guardia]').val();
    var empleado= $('select[name=empleado]').val();
    var url="index.php?page=rolesreten&accion=verificaRolxTgxEmp"
    $.ajax({   
        type: "POST",
        url:url,
        data:{
            guardia:guardia, 
            fecha:fecha,
            dependencia:dependencia,
            empleado:empleado
        },
        success: function(datos){       
            $('#editar').html(datos);
        }
    });
}
/*
 * llama al metodo ajax para insertar nuevo rol
 * 
 */

 function insertarNuevoRol(){
    var tipoguardia = $('select[name=guardia]').val();
    var url="index.php?page=rolesreten&accion=insertar"
    $.ajax({   
        type: "POST",
        url:url,
        data:{
            fecha:fecha,
            dependencia:dependencia,
            tipoguardia:tipoguardia,
            estado:estadoRol
        },
        success: function(datos){ 
            console.log(datos);
            $('').html(datos);
            cargarDatosRoles(fecha, dependencia);
            estadoRol = 0;
            $('#editar').html("");
            $('#mensajeDetalle').html(datos);
            //alert("Datos registrados");
        }
    });
}

function insertarNuevoRol2(){
    var guardia = $('select[name=guardia]').val();
    var idrol = $('input[name=estidrol]').val();
    var empleado= $('select[name=empleado]').val();
    var chkjefe = document.getElementById('chkjefe');
    var val;
    if(chkjefe.checked === true){
        val = 1;
    }else{
        val = 0;
    } 
    var url="index.php?page=rolesreten&accion=insertar2"
    $.ajax({   
        type: "POST",
        url:url,
        data:{
            fecha:fecha,
            dependencia:dependencia,
            guardia:guardia,
            estado:estadoRol,
            idrol: idrol,
            empleado:empleado,
            jefe:val,
        },
        success: function(datos){ 
            //console.log(datos);
            //$('').html(datos);
            //cargarDatosRoles(fecha, dependencia);
            //estadoRol = 0;
            $('#mensajeDetalle').html(datos);
            //alert("Datos registrados");
        }
    });
}

function insertarNuevoRol3(){
    var guardia = $('select[name=guardia]').val();
    var idrol = $('input[name=estidrol]').val();
    var empleado= $('select[name=empleado]').val();
    var chkjefe = document.getElementById('chkjefe');
    var val;
    if(chkjefe.checked === true){
        val = 1;
    }else{
        val = 0;
    } 
    var url="index.php?page=rolesreten&accion=insertar3"
    $.ajax({   
        type: "POST",
        url:url,
        data:{
            fecha:fecha,
            dependencia:dependencia,
            guardia:guardia,
            estado:estadoRol,
            idrol: idrol,
            empleado:empleado,
            jefe:val,
        },
        success: function(datos){ 
            //console.log(datos);
            //$('').html(datos);
            //cargarDatosRoles(fecha, dependencia);
            //estadoRol = 0;
            $('#mensajeDetalle').html(datos);
            //alert("Datos registrados");
        }
    });

}



function editarRol(cod, ind){
    estadoRol = cod;
    $('#editar').html("<h5><span class='label label-danger'>Edicion activada</span></h5>");
    $("select#guardia").val(ind);
}

function cancelarEdicionRol(){
    estadoRol = 0;
    $('#editar').html("");
}

/*
 * elimina un rol de turno
 */

 function eliminarRoles(cod){
    var a = confirm('Esta seguro de eliminar?');
    if(a == true){
        var url="index.php?page=rolesreten&accion=eliminar"
        $.ajax({   
            type: "POST",
            url:url,
            data:{
                rol:cod
            },
            success: function(datos){       
                $('').html(datos);
                cargarDatosRoles(fecha, dependencia);
            }
        });
    }
}

function cargarDetalles(cod, fila) {
    var codigo = cod;
    roldeturno = codigo;
    var url="index.php?page=rolesreten&accion=cargardetalles"
    $.ajax({   
        type: "POST",
        url:url,
        data:{
            codigo:codigo
        },
        success: function(datos){       
            $('#detallesrolesturno').html(datos);
        }
    });
    var botonagregardet = document.getElementById('agregdet');
    botonagregardet.disabled = false;
}

function insertarDetalles(){
    var empleado= $('select[name=empleado]').val();
    var chkjefe = document.getElementById('chkjefe');
    var val;
    if(chkjefe.checked === true){
        val = 1;
    }else{
        val = 0;
    }   
    var url="index.php?page=rolesreten&accion=insertardet"
    $.ajax({   
        type: "POST",
        url:url,
        data:{
            turno:roldeturno,
            empleado:empleado,
            jefe:val,
            fecha:fecha
        },
        success: function(datos){       
            $('#mensajeDetalle').html(datos);
            cargarDetalles(roldeturno);
        }
    });
    cargarDetalles(roldeturno);
}

/*
 * elimina a un empleado de un determinado
 * turno
 */

 function eliminarDetalles(rol, emp){
    var a = confirm('Esta seguro de eliminar?');
    if(a == true){
        var url="index.php?page=rolesreten&accion=eliminardet"
        $.ajax({   
            type: "POST",
            url:url,
            data:{
                turno:rol,
                empleado:emp
            },
            success: function(datos){       
                $('').html(datos);
            }
        });
    }
    cargarDetalles(roldeturno);
}

function eliminarDetalles2(){
    //var a = confirm('Esta seguro de eliminar?');
    //if(a == true){
        var idrol = $('input[name=estidrol]').val();
        var guardia = $('select[name=guardia]').val();
        var empleado= $('select[name=empleado]').val();
        var url="index.php?page=rolesreten&accion=eliminardet2"
        $.ajax({   
            type: "POST",
            url:url,
            data:{
                turno:idrol,
                empleado:empleado,
                guardia:guardia,
                fecha:fecha,
                dependencia:dependencia
            },
            success: function(datos){       
                $('#mensajeDetalle').html(datos);
            }
        });
    //}
}

/*
 * muestra la tabla de programacion de turnos
 */

 function verProgramacion(){
    var dep = $('input[name=dep_id]').val();
    var date = $("#calendar").fullCalendar('getDate');
    var month = date.getMonth() + 1;
    var year = date.getFullYear();
    //window.location.href = "index.php?page=rolesturnos&accion=program&d="+dep+"&m="+month+"&a="+year;
    window.window.open("index.php?page=rolesreten&accion=program&d="+dep+"&m="+month+"&a="+year);
}