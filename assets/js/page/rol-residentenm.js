$(document).on('ready', function(){


	// Trae las dependencias que pertenecen a un determinado departamento
	var getDependencias = function(departamento){

		var options = {
			type: 'POST',
			url:'index.php?page=rolmedicos&accion=ajaxGetDependencias',
			data: {
				'departamento': departamento,
			},
			dataType: 'html',
			success: function(response){

				$('#dependencia').removeAttr('disabled');
				$('#dependencia').html(response);
				/*
				if(response.error){
					bootbox.alert("ERROR: La Programación de para esta DEPENDENCIA, MES y AÑO ya ha sido generada.");
				}else{
					bootbox.alert("La Programación ha sido generada con éxito.", function(){
						
						window.location = 'index.php?page=reportes&accion=form';
					});
				}

				*/
			}
		};
		$.ajax(options);

	};

	$('#departamentos').on('change', function(e){
		e.preventDefault();

		var departamento = $(this).val();

		if(departamento != -1){
			getDependencias(departamento);			
		}else{
			$('#dependencia').attr('disabled', 'disabled');
			$('#dependencia').val('-1');
		}
	});

	var estructura_rol = $('#estructura_rol');
	var ajax_actividades = $('#ajax_actividades');


	$('#programacion-rol-medico').on('submit', function(e){
		e.preventDefault();

		var fecha = $('#fecha').val();
		var dependencia = $('#dependencia').val();
		var dependencia_text = $("#dependencia option:selected").text();

		

		if(dependencia != -1){

			estructura_rol.slideUp("slow", function(){

				var options = {
					type: 'POST',
					url:'index.php?page=rolresidentenm&accion=ajaxGetEstadoProg',
					data: {
						'dependencia': dependencia,
						'fecha':fecha,
					},
					dataType: 'html',
					success: function(response){
						ajax_actividades.html('');
						$('#dependenciaActualTXT').val('');						
						$('#dependenciaActualTXT').html(dependencia_text);
						$('#dependenciaActualAgregarTXT').html(dependencia_text);
						$('#dependenciaActual').val(dependencia);
						ajax_actividades.html(response);						
						estructura_rol.slideDown("slow");
					}
				};			

				$.ajax(options);



			});
			



			/*
			var options = {
				type: 'POST',
				url:'index.php?page=rolmedicos&accion=ajaxCheckRolMedico',
				data: {
					'fecha': fecha,
					'dependencia': dependencia
				},
				dataType: 'json',
				success: function(response){
					if(!response.error){
						if(response.exists){
							
						}
					}
				}
			};

			//$.ajax(options);

			*/


		}else{
			alert("Debe seleccionar una dependencia válida.");

		}




	});

	$('body').on('click', '#btnAgregarActividad', function(e){
		e.preventDefault();
		
		var ajax_agregar_actividades = $('#ajax_agregar_actividades');

		var dependencia = $('#dependencia').val();
		

		var _options = {
			type: 'POST',
			url:'index.php?page=rolmedicos&accion=ajaxGetActividadesAgregar',
			data: {
				'dependencia': dependencia
			},
			dataType: 'html',
			success: function(response){
				ajax_agregar_actividades.html('');
				ajax_agregar_actividades.html(response);

				$('#formulario-registro').modal('show');
			}
		};

		$.ajax(_options);	
		
	});

	// Funcion que funciona al clickear un checkbox de una ACTIVIDAD que se desea 
	// Agregar o Eliminar

	$('body').on('click', '.agregarActividad', function(e){
		//e.preventDefault();
		// Variable que verifica si se quiere agregar o remover

		var checkboxClickeado = $(this);


		var agregar = $(this).is(':checked');
		var dependencia = $('#dependenciaActual').val();
		var actividad = $(this).data('actividad');

		var loading = $(".loading-"+actividad);

		checkboxClickeado.hide();
		loading.show();

		if(agregar){
			var accion = "agregar";
		}else{
			var accion = "eliminar";
		}

		var _options = {
			type: 'POST',
			url:'index.php?page=rolmedicos&accion=ajaxManejarActividad',
			data: {
				'dependencia': dependencia,
				'actividad': actividad,
				'accion': accion
			},
			dataType: 'json',
			success: function(response){
				checkboxClickeado.show();
				loading.hide();
				//console.log(response);
				//ajax_agregar_actividades.html('');
				//ajax_agregar_actividades.html(response);

				//$('#formulario-registro').modal('show');
			}
		};

		$.ajax(_options);		
	});

	$('#dependencia').on('change', function(e){
		estructura_rol.slideUp("fast");
	});

	$('#formulario-registro').on('hidden.bs.modal', function(){

		var dependencia = $('#dependenciaActual').val();

		ajax_actividades.fadeOut('fast', function(){
			var options = {
				type: 'POST',
				url:'index.php?page=rolmedicos&accion=ajaxGetActividades',
				data: {
					'dependencia': dependencia
				},
				dataType: 'html',
				success: function(response){
					$('#dependenciaActual').val(dependencia);
					ajax_actividades.html('');
					ajax_actividades.html(response);						
					ajax_actividades.fadeIn('slow');
				}
			};

			$.ajax(options);

		});

	});


	$('body').on('click', '#btnFinalizarAgregado', function(e){
		e.preventDefault();

		$('#formulario-registro').modal('hide');

	});



	// Variable que almacena el id de la actividad de dependencia de la cual se están mostrando los turnos;
	var actividad_dep_seleccionada = -1;

	$('body').on('click', '.actividad_de_especialidad', function(e){
		e.preventDefault();

		// Removiendo CSS 

		$('.actividad_de_especialidad').each(function(){
			$(this).removeClass('actividad_seleccionada');
		});

		$(this).addClass('actividad_seleccionada');



		//$(this).css('background-color', '#158cba');
		//$(this).css('font-weight', 'bold');
		//alert("Click");

		var dep_act_id = $(this).data('id_dep_act');

		//console.log(dep_act_id);

		actividad_dep_seleccionada = dep_act_id;

		var actividad_actual_txt = $(this).data('id_dep_act_txt');

		$('#actividadActualAgregarTXT').html(actividad_actual_txt);

		getTurnosHorario(actividad_dep_seleccionada, $('#ajax_turnos_horario'));


	});


	// Obtener turnos_horario de una actvidad_dependencia


	var getTurnosHorario = function(actividad_dep, target){

			var options = {
				type: 'POST',
				url:'index.php?page=rolmedicos&accion=ajaxGetTurnos',
				data: {
					'dep_act_id': actividad_dep
				},
				dataType: 'html',
				success: function(response){
					target.fadeOut('fast', function(){


						target.html('');
						target.html(response);
						target.fadeIn('slow');

					});
				}
			};

			$.ajax(options);


	}

	/*********************** MANEJAR TURNOS DE UNA ACTIVIDAD ****************************/

	// Modal
	var modal_agregar_turnos = $('#formulario-turnos');

	$('body').on('click', '#btnAgregarTurno', function(e){
		e.preventDefault();


		var target = $('#ajax_agregar_turnos');
		if(actividad_dep_seleccionada != -1){

			var options = {
				type: 'POST',
				url:'index.php?page=rolmedicos&accion=ajaxGetTurnosAgregar',
				data: {
					'dep_act_id': actividad_dep_seleccionada
				},
				dataType: 'html',
				success: function(response){
						target.html('');
						target.html(response);						
						modal_agregar_turnos.modal("show");
				}
			};

			$.ajax(options);			




		}else{
			bootbox.alert("Para poder agregar un Turno/Guardia debe seleccionar una Actividad antes.", function(){});
		}
	});

	// Funcion que funciona al clickear un checkbox de un TURNO
	// que se desea Agregar o Eliminar

	$('body').on('click', '.agregarTurnoHorario', function(e){
		//e.preventDefault();
		// Variable que verifica si se quiere agregar o remover

		var checkboxClickeado = $(this);


		var agregar = $(this).is(':checked');


		
		var turnoHorario = $(this).data('turno-horario');

		//console.log(actividad_dep_seleccionada, turnoHorario);

		var loading = $(".loading-"+turnoHorario);

		checkboxClickeado.hide();
		loading.show();

		if(agregar){
			var accion = "agregar";
		}else{
			var accion = "eliminar";
		}

		var _options = {
			type: 'POST',
			url:'index.php?page=rolmedicos&accion=ajaxManejarTurnoHorario',
			data: {
				'actividadDependencia': actividad_dep_seleccionada,
				'turnoHorario': turnoHorario,
				'accion': accion
			},
			dataType: 'json',
			success: function(response){
				checkboxClickeado.show();
				loading.hide();
				//console.log(response);
				//ajax_agregar_actividades.html('');
				//ajax_agregar_actividades.html(response);

				//$('#formulario-registro').modal('show');
			}
		};

		$.ajax(_options);		
	});



	$('body').on('click', '#btnFinalizarAgregadoTurnos', function(e){
		e.preventDefault();
		modal_agregar_turnos.modal('hide');
	});


	// Cuando el modal se cierra
	modal_agregar_turnos.on('hidden.bs.modal', function(){
		getTurnosHorario(actividad_dep_seleccionada, $('#ajax_turnos_horario'));
	});



	//Cuando se Crea la Programación


	$('body').on('click', '#btnCrearProgramacion', function(e){
		e.preventDefault();

		var dpto = $('#departamentos').val();

		var dependencia = $('#dependencia').val();

		var fecha = $('#fecha').val()

		if (dpto != -1 && dependencia != -1 && fecha !=-1){

			//console.log(dpto, dependencia, fecha);




			var options = {
				type: 'POST',
				url:'index.php?page=rolresidentenm&accion=ajaxCrearProgramacion',
				data: {
					'departamento': dpto,
					'dependencia': dependencia,
					'fecha': fecha

				},
				dataType: 'json',
				success: function(response){
						//target.html('');
						//target.html(response);						
						//modal_agregar_turnos.modal("show");
						if(response.created){
							bootbox.alert(response.msg, function(){
								window.location = 'index.php?page=rolresidentenm&accion=programacionesPendientes';

							});
							
						}else{							
							bootbox.alert(response.msg, function(){});
						}
						
				}
			};

			$.ajax(options);




		}else{

			bootbox.alert("Se debe seleccionar un Departamento, Dependencia y Fecha....", function(){});			
		}

	});


	// Previsualizar Rol 


	var previsualizarRol = function(prog_id){

			var options = {
				type: 'POST',
				url:'index.php?page=rolmedicos&accion=programacion',
				data: {
					'id': prog_id
				},
				dataType: 'html',
				success: function(response){
						$('#divPrevisualizacion').html('');
						$('#divPrevisualizacion').html(response);
						$('#previsualizacion').fadeIn('slow');

						//target.html(response);
						//modal_agregar_turnos.modal("show");
						
				}
			};

			$.ajax(options);		

	};


	var paraProgramarRol = function(prog_id){

			var options = {
				type: 'POST',
				url:'index.php?page=rolmedicos&accion=paraProgramar',
				data: {
					'id': prog_id
				},
				dataType: 'html',
				success: function(response){
						$('#divPrevisualizacion').html('');
						$('#divPrevisualizacion').html(response);
						$('#previsualizacion').fadeIn('slow');

						//target.html(response);
						//modal_agregar_turnos.modal("show");
						
				}
			};

			$.ajax(options);		

	};


	paraProgramarRol($('#prog_id').val());

	$('body').on('click', '#btnPrevisualizarRol', function(e){
		e.preventDefault();

		$('#previsualizacion').fadeOut('fast', function(){
			var prog_id = $('#prog_id').val();

			previsualizarRol(prog_id);



		});

	});

	var detalle;
	var prog_id;
	var dia;
	var mes;
	var anio;


	$('body').on('click', '.detalleProg', function(e){
		e.preventDefault();


		detalle = $(this).data('turno-horario');
		prog_id = $('#prog_id').val();
		dia = $(this).data('dia');
		mes = $('#prog_mes').val();
		anio = $('#prog_anio').val();



		$('#programacion-detalle').modal('show');




		
		//alert("Me clickeaste");
	});


	$('body').on('click', '#btnInsertarDetalle', function(e){
		e.preventDefault();


		var emp = $('#cboempleado').val();
		insertarDetalle(emp, detalle, prog_id, dia, mes, anio);


	});

	 var insertarDetalle = function(emp, detalle, prog_id, dia, mes, anio){

			var options = {
				type: 'POST',
				url:'index.php?page=rolmedicos&accion=ajaxInsertarDetalle',
				data: {
					'empleado': emp,
					'detalle': detalle,
					'prog_id': prog_id,
					'dia': dia,
					'mes': mes,
					'anio': anio
				},
				dataType: 'html',
				success: function(response){
						//$('#divPrevisualizacion').html('');
						//$('#divPrevisualizacion').html(response);
						//$('#previsualizacion').fadeIn('slow');
						//$('#turno').html(response);
						//target.html(response);
						//modal_agregar_turnos.modal("show");

						$('#programacion-detalle').modal('hide');
						paraProgramarRol($('#prog_id').val());
						
				}
			};

			$.ajax(options);	 	

	 };


	$('#actividad').on('change', function(e){
		e.preventDefault();
		var actividad = $(this).val();

		if(actividad !=-1){

			var options = {
				type: 'POST',
				url:'index.php?page=rolmedicos&accion=ajaxGetTurnosParaProgramar',
				data: {
					'actividad': actividad
				},
				dataType: 'html',
				success: function(response){
						//$('#divPrevisualizacion').html('');
						//$('#divPrevisualizacion').html(response);
						//$('#previsualizacion').fadeIn('slow');
						$('#turno').html(response);
						//target.html(response);
						//modal_agregar_turnos.modal("show");
						
				}
			};

			$.ajax(options);



		}else{

		}


	});



	///////////////////////////////////////////////////////
	
	var modal_comentarios = $('#modal-agregar-comentario');
	var ajax_comentarios = $('#ajax_comentarios');

	$('body').on('click', '#btnAgregarComentario', function(e){
		e.preventDefault();


		modal_comentarios.modal('show');
	});


	$('body').on('click', '#btnInsertarComentario', function(e){
		e.preventDefault();

		var prog_id = $('#prog_id').val();

		var comentario = $('#comentario').val().trim();

		if(comentario.length > 0){

			var options = {
				type: 'POST',
				url:'index.php?page=rolresidentenm&accion=ajaxAgregarComentario',
				data: {
					'prog_id': prog_id,
					'comentario': comentario
				},
				dataType: 'html',
				success: function(response){
						//$('#divPrevisualizacion').html('');
						//$('#divPrevisualizacion').html(response);
						//$('#previsualizacion').fadeIn('slow');
						//$('#turno').html(response);
						//target.html(response);
						//modal_agregar_turnos.modal("show");
						
					modal_comentarios.modal('hide');

					getComentarios(prog_id);
					getValidaciones(prog_id);
				}
			};

			$.ajax(options);		
			
		}else{

			bootbox.alert("Debe insertar una Comentario válida...", function(){});
		}





	});

	// Cuando se cierra el modal de agregar observaciones

	modal_comentarios.on('hidden.bs.modal', function(){

		var prog_id = $('#prog_id').val();	
		getComentarios(prog_id);
	});


	var getComentarios = function(prog_id){


		var options = {
			type: 'POST',
			url:'index.php?page=rolmedicos&accion=ajaxGetComentarios',
			data: {
				'prog_id': prog_id
			},
			dataType: 'html',
			success: function(response){

					ajax_comentarios.html('');
					ajax_comentarios.html(response);
					ajax_comentarios.fadeIn('slow');
					//$('#divPrevisualizacion').html(response);
					//$('#previsualizacion').fadeIn('slow');
					//$('#turno').html(response);
					//target.html(response);
					//modal_agregar_turnos.modal("show");
					
			}
		};

		$.ajax(options);				


	};

	var prog_id = $('#prog_id').val();
	getComentarios(prog_id);


	////////////////////////////////////////////





	var modal_observaciones = $('#modal-agregar-observacion');
	var ajax_observaciones = $('#ajax_observaciones');

	$('body').on('click', '#btnAgregarObservacion', function(e){
		e.preventDefault();


		modal_observaciones.modal('show');
	});


	$('body').on('click', '#btnInsertarObservacion', function(e){
		e.preventDefault();

		var prog_id = $('#prog_id').val();

		var observacion = $('#observacion').val().trim();

		if(observacion.length > 0){

			var options = {
				type: 'POST',
				url:'index.php?page=rolresidentenm&accion=ajaxAgregarObservacion',
				data: {
					'prog_id': prog_id,
					'observacion': observacion
				},
				dataType: 'html',
				success: function(response){
						//$('#divPrevisualizacion').html('');
						//$('#divPrevisualizacion').html(response);
						//$('#previsualizacion').fadeIn('slow');
						//$('#turno').html(response);
						//target.html(response);
						//modal_agregar_turnos.modal("show");
						
					modal_observaciones.modal('hide');

					getObservaciones(prog_id);
					getValidaciones(prog_id);
				}
			};

			$.ajax(options);		
			
		}else{

			bootbox.alert("Debe insertar una observación válida...", function(){});
		}





	});

	// Cuando se cierra el modal de agregar observaciones

	modal_observaciones.on('hidden.bs.modal', function(){

		var prog_id = $('#prog_id').val();	
		getObservaciones(prog_id);
	});


	$(document).on('click','#corregir',function(){
		
		var prog_id = $('#prog_id').val();
		var obs = $(this).attr('value');
    // alert(obs);
// e.preventDefault();
    bootbox.confirm("ADVERTENCIA: Realmente queire Corregir esta Observacion??", function(result) { 
    	if(result){
    		var url="index.php?page=rolresidentenm&accion=ajaxActualizarObservacion"
    		$.ajax({   
    			type: "POST",
    			url:url,
    			data:{
    				obs:obs
    			},
    			success: function(response){       
    				getObservaciones(prog_id);
    			}
    		});
    	}
    });
});







	var getObservaciones = function(prog_id){


		var options = {
			type: 'POST',
			url:'index.php?page=rolmedicos&accion=ajaxGetObservaciones',
			data: {
				'prog_id': prog_id
			},
			dataType: 'html',
			success: function(response){

					ajax_observaciones.html('');
					ajax_observaciones.html(response);
					ajax_observaciones.fadeIn('slow');
					//$('#divPrevisualizacion').html(response);
					//$('#previsualizacion').fadeIn('slow');
					//$('#turno').html(response);
					//target.html(response);
					//modal_agregar_turnos.modal("show");
					
			}
		};

		$.ajax(options);				


	};

	var prog_id = $('#prog_id').val();
	getObservaciones(prog_id);




	var modal_validaciones = $('#modal-agregar-validacion');

	$('body').on('click', '#btnAgregarValidacion', function(e){
		e.preventDefault();


		modal_validaciones.modal('show');
	});

	var ajax_validaciones = $('#ajax_validaciones');

	$('body').on('click', '#btnInsertarValidacion', function(e){
		e.preventDefault();


		
		var validacion = $('#validacion').val();
		var tipoprog = $('#tipoprog').val();

		var options = {
			type: 'POST',
			url:'index.php?page=rolresidentenm&accion=ajaxInsertarValidacion',
			data: {
				'prog_id': prog_id,
				'validacion': validacion,
				'tipoprog':tipoprog
			},
			dataType: 'html',
			success: function(response){

					modal_validaciones.modal('hide');
					getValidaciones(prog_id);

					if (validacion == 4) {
						window.location = "index.php?page=rolresidentenm&accion=programacionesAprobadas";
					};

					//ajax_validaciones.html('');
					//ajax_validaciones.html(response);
					//ajax_validaciones.fadeIn('slow');
					//$('#divPrevisualizacion').html(response);
					//$('#previsualizacion').fadeIn('slow');
					//$('#turno').html(response);
					//target.html(response);
					//modal_agregar_turnos.modal("show");
					
			}
		};

		$.ajax(options);		

		


	});


	var getValidaciones = function(prog_id){


		var options = {
			type: 'POST',
			url:'index.php?page=rolmedicos&accion=ajaxGetValidaciones',
			data: {
				'prog_id': prog_id
			},
			dataType: 'html',
			success: function(response){

					ajax_validaciones.html('');
					ajax_validaciones.html(response);
					ajax_validaciones.fadeIn('slow');
					//$('#divPrevisualizacion').html(response);
					//$('#previsualizacion').fadeIn('slow');
					//$('#turno').html(response);
					//target.html(response);
					//modal_agregar_turnos.modal("show");
					
			}
		};

		$.ajax(options);			

	}


	modal_validaciones.on('hidden.bs.modal', function(){

		var prog_id = $('#prog_id').val();
		getValidaciones(prog_id);
	});

	getValidaciones(prog_id);



	$('body').on('contextmenu', '.detalleProg', function(e){
		e.preventDefault();

		var detalle = $(this).data('detalle');

		bootbox.confirm("ADVERTENCIA: Realmente queire eliminar este registro??", function(result) {    
			if(result){
							var options = {
				type: 'POST',
				url:'index.php?page=rolmedicos&accion=ajaxBorrarDetalle',
				data: {
					'detalle': detalle
				},
				dataType: 'html',
				success: function(response){
						//$('#divPrevisualizacion').html('');
						//$('#divPrevisualizacion').html(response);
						//$('#previsualizacion').fadeIn('slow');
						//$('#turno').html(response);
						//target.html(response);
						//modal_agregar_turnos.modal("show");
						paraProgramarRol($('#prog_id').val());						
				}
			};

			$.ajax(options);

			}

		});
	});	


});