
/*
 *  [ -----------------  FUNCIONES JAVASCRIPT   --------------------- ]
 */ 

$(document).ready(function() {
    cargarcomboreporte();
});

function cargarcomboreporte(){
    var opc  = document.getElementById("cmbselect").value;
    if(opc == 1){
        cargarFormulario("cmbreporte", "index.php?page=reportes&accion=cargarporemp");        
    }else if(opc == 2){
        cargarFormulario("cmbreporte", "index.php?page=reportes&accion=cargarporserv");
    }else if(opc == 3){
        cargarFormulario("cmbreporte", "index.php?page=reportes&accion=cargarResolemp");
    }else if(opc == "reporte-raciones-programadas"){
        cargarFormulario("cmbreporte", "index.php?page=reportes&accion=cargarParaRaciones");
    }else if(opc == "reporte-raciones-programadas-grupo-ocupacional"){
        cargarFormulario("cmbreporte", "index.php?page=reportes&accion=cargarParaRacionesporGrupoO"); 
    }else if (opc == "reporte-raciones-marcadas-dia"){ 
        cargarFormulario("cmbreporte", "index.php?page=reportes&accion=mostrarMarcadosDia")//aqui por dia
    }else if (opc == "reporte-raciones-marcadas-mes"){
        cargarFormulario("cmbreporte", "index.php?page=reportes&accion=mostrarMarcadosMes");//aqui por mes
    }else if (opc == "reporte-consolidado-mensual"){
        cargarFormulario("cmbreporte", "index.php?page=reportes&accion=mostrarfecha");//aqui por mes
    }else if(opc == 4){
        cargarFormulario("cmbreporte", "index.php?page=reportes&accion=cargarolmedico");
    }else if(opc == 5){
        cargarFormulario("cmbreporte", "index.php?page=reportes&accion=cargarPorFichaGuardiasPerzo");
    }else if(opc == 6){
        cargarFormulario("cmbreporte", "index.php?page=reportes&accion=cargarPorFichaGuardiasPerzoHc");
    }else if(opc == 7){
        cargarFormulario("cmbreporte", "index.php?page=reportes&accion=cargarPorFichaGuardiasPerzoRt");
    }else if(opc == 8){
        cargarFormulario("cmbreporte", "index.php?page=reportes&accion=cargarolmedico");
    }
}

/*
 *  [ -----------------  FUNCIONES AJAX   --------------------- ]
 */

function nuevoAjax()  {  
    var xmlhttp=false;  
    try  {  
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");  
    }  
    catch (e)  {  
        try  {  
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");  
        }  
        catch (e)  {  
            xmlhttp = false;  
        }  
    }  
    if (!xmlhttp && typeof XMLHttpRequest!='undefined')  {  
        xmlhttp = new XMLHttpRequest();  
    }  
    return xmlhttp;  
}  

function cargarFormulario(id, url)  {  
    var objDiv = document.getElementById(id);  
    ajax = nuevoAjax();  
    ajax.open("POST", url, true);  
    ajax.onreadystatechange = function() {
        switch (ajax.readyState) {  
            case 4:
                if(ajax.status == 200)  {  
                    objDiv.innerHTML = "";  
                    objDiv.innerHTML = ajax.responseText;  
                }  
                else {  
                    objDiv.innerHTML = 'Error 200';  
                }  
                break;  
        }  
    }  
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");  
    ajax.send();
} 

