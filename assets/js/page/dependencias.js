$(document).on('ready', function(){

//changedepartamentos();
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


function changedepartamentos() {
	
	alert('alerta');
}



	$('#departamentos2').on('change', function(e){
		// e.preventDefault();

		 alert('holas');
		var departamento = $(this).val();

		// if(departamento != -1){
		// 	// getDependencias(departamento);
		// 	$('#dependencia').attr('disabled', 'disabled');
		// 	$('#dependencia').val('-1');

		// }else{
		// 	getDependencias(departamento);
		// 	// $('#dependencia').attr('disabled', 'disabled');
		// 	// $('#dependencia').val('-1');
		// }
	});


$(document).on('change', '#departamentos', function(){
//alert('alertaaaaaaa');	
		var departamento = $(this).val();

		if(departamento != -1){
			getDependencias(departamento);
			

		}else{
			
			$('#dependencia').attr('disabled', 'disabled');
			$('#dependencia').val('-1');
			 }
});

});


