$(document).on('ready', function(){
	var GenerarProgramacion = $('#nutricion-generar-programacion');


	var generar_programacion = function(servicio, fecha){
		var options = {
			type: 'POST',
			url:'index.php?page=nutricion&accion=generarProgramacionAjax',
			data: {
				'servicio': servicio,
				'fecha': fecha
			},
			dataType: 'json',
			success: function(response){
				if(response.error){
					bootbox.alert("ERROR: La Programación de para esta DEPENDENCIA, MES y AÑO ya ha sido generada.");
				}else{
					bootbox.alert("La Programación ha sido generada con éxito.", function(){
						
						window.location = 'index.php?page=reportes&accion=form';
					});
				}
			}
		};

		$.ajax(options);

	};




	// Cuando le doy click al boton Generar Programación Envia el formulario
	GenerarProgramacion.on('submit', function(e){
		e.preventDefault()
		var servicio = $('#servicio').val();
		var fecha = $('#fecha').val();

		bootbox.confirm("ADVERTENCIA: La programación sólo se generar UNA vez por DEPENDENCIA y MES-AÑO, Desea Continuar?", function(result) {    
			if(result){
				generar_programacion(servicio, fecha);
			}

		});
	});
});