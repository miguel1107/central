function cargaportipo() {
  var este=$('#tipoeste').val();
  window.cargaesterilizador.llenaingresos(este);
  cargaMaquinas(este);
}

function ver(id) {
  var tipo=$('#tipoeste').val();
  for (var i = 0; i < window.cargaesterilizador.data.ingresos.length; i++) {
    if (id==window.cargaesterilizador.data.ingresos[i].iding) {
      var descripcion=window.cargaesterilizador.data.ingresos[i].descripcion;
    }
  }
  window.cargaesterilizador.llenatabla(id,tipo,descripcion);
}

function verMat(id) {
  var tip=window.cargaesterilizador.data.materiales[id].tipo;
  if (tip=='Mat') {
  }else if(tip=='Set'){
    var det=window.cargaesterilizador.data.materiales[id].idset;
    $("#modal-table").modal('show');
    window.cargaesterilizador.llenaDetalle(det,tip);
  }else if (tip=='Kit') {
    var det=window.cargaesterilizador.data.materiales[id].idkit;
    $("#modal-table").modal('show');
    window.cargaesterilizador.llenaDetalle(det,tip);
  }
}

function cargar(id,cant,aux) {
  $("#emp").modal('show');
  var falta=window.cargaesterilizador.data.materiales[aux].porcargar;
  window.cargaesterilizador.llenaparacarga(id,cant,falta,aux);
}

function agregaCarga() {
  var iddet=$("#iddetalleMod").val();
  var cantagre=$("#cantEmapacar").val();
  var position=$("#position").val();
  var tipo=$("#tipoeste").val();
  window.cargaesterilizador.agregaCarga(iddet,cantagre,position,tipo);
}

function eliminaCarga(i){
  var detalle=window.cargaesterilizador.data.carga[i].iddetalle;
  var cant=parseInt(window.cargaesterilizador.data.carga[i].cantidad);
  var au=[];
  for (var j = 0; j < window.cargaesterilizador.data.materiales.length; j++) {
    if (detalle=window.cargaesterilizador.data.materiales[j].idDetalle) {
      var inicial=parseInt(window.cargaesterilizador.data.materiales[j].porcargar);
      var fin=inicial+cant;
      console.log(inicial+'-'+fin);
      window.cargaesterilizador.data.materiales[j].porcargar=fin;
    }
  }
  for (var z = 0; z < window.cargaesterilizador.data.carga.length; z++) {
    if (z!=i) {
      au.push(window.cargaesterilizador.data.carga[z]);
    }
  }
  window.cargaesterilizador.data.carga=au;
  window.cargaesterilizador.llenaCargaEste();
  window.cargaesterilizador.llenaCarga();
}

function cargaMaquinas(este) {
  var options={
    type: 'post',
    url: 'index.php?c=ctrEsterilizador&a=llenaCombo',
    data:{
      este: este
    }
  };
 	$.ajax(options).done(function(data) {
 		$('#cmbMaquina').html(data);
 	});
}

function registroCarga() {
  var maquina=$('#cmbMaquina').val();
  var materiales=(window.cargaesterilizador.data.carga);
  var mat=[];
  for (var i = 0; i < materiales.length; i++) {
    var m=[];
    m[0]=materiales[i].iddetalle;
    m[1]=materiales[i].cantidad;
    m[2]=materiales[i].faltacargar;
    mat.push(m);
  }
  if (maquina=='0') {
    $('#contenidoWarning').text('Seleccione Esterilizador');
    $("#alertWarning").modal('show');
  }else if (mat.length==0) {
    $('#contenidoWarning').text('Seleccione Carga');
    $("#alertWarning").modal('show');
  }else{
    var options={
      type : 'post',
      url : 'index.php?c=ctrCargaEsterilizacion&a=registroCarga',
      data: {
        'maquina': maquina,
        'materiales': mat
      },
    };
    $.ajax(options).done(function (data) {
      if(data==1){
        $('#contenidoExito').text('Registro Existoso!!');
        $("#alertExito").modal('show');
      }else{
        $('#contenidoError').text('Error al insertar!!');
        $("#alertError").modal('show');
      }
    });
  }
}

function redireccionar() {
  location.reload(true);
}


function cancelar() {
  window.cargaesterilizador.cancelar();
}

$(document).ready(function() {
  $('#cantEmapacar').blur(function() {
    var emp=$('#cantEmapacar').val();
    var cant=$('#cantEmp').val();
    if (emp>cant) {
      alert('ERROR: la cantidad de empaques no es correcta');
      $('#cantEmapacar').val('');
      $('#cantEmapacar').focus();
    }
  });
});
