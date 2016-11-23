$(document).on('ready', function(){
    var Ayuda = $('#btnayuda');
    // Cuando le doy click al boton Generar Programación Envia el formulario
    Ayuda.on('click', function(e){
        e.preventDefault()


        bootbox.alert("<br/><b><center>COMUNICADO OFICIAL</center></b></br><p align='justify'>Es grato saludarlo y a la vez dirigirme a su despacho haciéndole de conocimiento que de acuerdo al Reglamento Interno de Guardias Hospitalarias Capitulo I De la Programación y Servicio de Reten según:</p></br><p align='justify'><b>Articulo 22°:</b> <b>“..La programación debe ser aprobada con una anticipación no menor de diez (10) días útiles al primer día del mes en que se efectúa..”</b> </br> Por lo tanto, instamos a todas las areas y/o Unidades de los diferentes Departamentos a cumplir con esta obligación, evitandose inconvenientes durante el proceso de la Programación de su Rol, ya que el Sistema se Cerrara pasada la Fecha Limite.</p></br><p align='right'><b>Unidad del Desarrollo Humano. Anexo:. 1020</b></p>", function(result) {    
            if(result){
                //generar_programacion(servicio, fecha);
            }

        });
    });
});
