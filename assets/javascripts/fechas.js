window.onload = function(){ 

	var dato = new Date();
	var fecha = dato.getDate();
	var mes = dato.getMonth();
	var año = dato.getFullYear();
	var meses = new Array(12);
	meses[0] = "Enero";
	meses[1] = "Febrero";
	meses[2] = "Marzo";
	meses[3] = "Abril";
	meses[4] = "Mayo";
	meses[5] = "Junio";
	meses[6] = "Julio";
	meses[7] = "Agosto";
	meses[8] = "Septiembre";
	meses[9] = "Octubre";
	meses[10] = "Noviembre";
	meses[11] = "Diciembre";
	
	var fechaActual = fecha + " de " + meses[mes] + " del " + año;
	
	document.getElementById("fecha").innerHTML = fechaActual;
}  