
/*
 *  [ -----------------  FUNCIONES JAVASCRIPT   --------------------- ]
 */ 

$(document).ready(function() {
    cargarcomboexportar();
});

// para exportar datos

function cargarcomboexportar(){
    var opc  = document.getElementById("cmbselect").value;
    if(opc == 1){
        cargarFormulario("cmbreporte", "index.php?page=exportar&accion=cargarexportarsiga");        
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

