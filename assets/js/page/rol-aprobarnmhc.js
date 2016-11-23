$(document).on('ready', function(){
	// Trae las dependencias que pertenecen a un determinado departamento
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

		if(dependencia != -1){

			estructura_rol.slideUp("slow", function(){

				var options = {
					type: 'POST',
					url:'index.php?page=rolmedicos&accion=ajaxGetActividades',
					data: {
						'dependencia': dependencia
					},
					dataType: 'html',
					success: function(response){
						ajax_actividades.html('');
						ajax_actividades.html(response);
						estructura_rol.slideDown("slow");
					}
				};			

				$.ajax(options);
			});
			
		}else{
			alert("Debe seleccionar una dependencia válida.");

		}

	});


/*              var producto = $(this).find('input[name=idprod]').val().split('|');
              var idpro = producto[0];   
              var cant = producto[1];*/

  	$(document).ready(function() {
  	$("button[name=mostrarprog]").click(function () {

	var d = $('#dependencia').val();
	var fecha = $('input[name=fecha]').val().split('-');
	var mes = fecha[1];
	var ano = fecha[0];
	var url2="index.php?page=rolesaprobar&accion=obtenerestadonmhc"
//alert(url2);	
$.ajax({   
		type: "POST",
		url:url2,
		data:{
			d:d,
			mes:mes,
			ano:ano,
			
		},
		success: function(datos){ 
			// console.log(datos);
			// $('').html(datos);
			// cargarDatosRoles(fecha, dependencia);
			// estadoRol = 0;
			// $('#editar').html("");
			$('#accionrol').html(datos);
			//alert(datos);
				}
			});
	//alert(ano);
	 //alert(mes);
	// href="index.php?page=rolesturnos&accion=program&d=27&m=7&a=2014"
	var url = "index.php?page=rolesnomedicoshc&accion=program&d="+d+"&m="+mes+"&a="+ano+"";
	//var url2 = $(this).attr('href');
	$('#iframe').attr('src', url);
	$('#iframe').reload();



		});
	});


    $(document).ready(function() {
       	$("button[name=guardarestado]").click(function () {
              		var d = $('#dependencia').val();
              		var fecha = $('input[name=fecha]').val().split('-');
              		var mes = fecha[1];
              		var ano = fecha[0];
              		var observacion = $('textarea[name=observacion]').val();
					var url="index.php?page=rolesaprobar&accion=actualizarestadonmhc"
              		if($("#optionsRadios1").is(':checked')) {  
              			var estado="1";
               		$.ajax({   
              			type: "POST",
              			url:url,
              			data:{
              				d:d,
              				mes:mes,
              				ano:ano,
              				estado:estado,
              				observacion:observacion,
              			},
              			success: function(datos){ 

              				alert("Aprobación Registrada");
              			}
              		});             			

              		} else {  
              			var estado="0"; 
              			//alert('mostrarmodal');
              			$("#observacion").val('');
              			$('#myModal').modal('show'); 
              		}

              	});
	});


    $(document).ready(function() {
       	$("button[name=btndesaprobar]").click(function () {
       		//alert('click');
              		var d = $('#dependencia').val();
              		var fecha = $('input[name=fecha]').val().split('-');
              		var mes = fecha[1];
              		var ano = fecha[0];
              		var observacion = $('textarea[name=observacion]').val();
					var url="index.php?page=rolesaprobar&accion=actualizarestadonmhc"

              			var estado="0";
               		$.ajax({   
              			type: "POST",
              			url:url,
              			data:{
              				d:d,
              				mes:mes,
              				ano:ano,
              				estado:estado,
              				observacion:observacion,
              			},
              			success: function(datos){ 
              				 
              				alert("Desaprobación Registrada");
              				$('#myModal').modal('hide');
              				$("#observacion").val('');
              				//$('txtobservacion').val('');
              			}
              		});             			

 

              	});
	});




});