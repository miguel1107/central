function ver(id){
  window.secadora.llenatabla(id);
}

function llenaCargaSec(){
  window.secadora.llenaCarga();
  $("#modal-table").modal('hide');
}

function cancelar() {
  window.secadora.cancelar();
}

function registroCargaSec(){
  var materiales=(window.secadora.data.materiales);
  var iding=(window.secadora.data.iding);
  var mat=[];
  var aux=0;
  var secadora=$('#secadora').val();
  for (var i = 0; i < materiales.length; i++) {
    if(materiales[i].estado=="TRUE"){
      aux=1;
      var m=[];
      m[0]=materiales[i].idDetalle;
      mat.push(m);
    }
  }
  if (aux==0) {
    $('#contenidoWarning').text('No seleccionó ningun material para la carga');
    $("#alertWarning").modal('show');
  }else if (secadora=='0') {
    $('#contenidoWarning').text('Escoja Secadora');
    $("#alertWarning").modal('show');
  }else{
    var options={
      type : 'post',
      url : 'index.php?c=ctrCargaSecadora&a=registraCargaSec',
      data: {
        'iding' : iding,
        'secadora' : secadora,
        'materiales' : mat
      },
    };
    $.ajax(options).done(function(data){
      if(data==1){
        $('#contenidoExito').text('Registro Correcto!!');
        $("#alertExito").modal('show');
      }else{
        $('#contenidoError').text('Error al Insertar!!');
        $("#alertError").modal('show');
      }
    })
  }
}

function desocupaSecadora(id) {
  var options={
    type : 'post',
    url : 'index.php?c=ctrCargaSecadora&a=descargarSecadora',
    data: {
      'idsec' : id
    },
  };
  $.ajax(options).done(function (data) {
    if(data==1){
      $('#contenidoExito').text('Descarga Existosa!!');
      $("#alertExito").modal('show');
    }else{
      $('#contenidoError').text('Error al Descargar!!');
      $("#alertError").modal('show');
    }
  })
}

function registroSecManual(){
  var materiales=(window.secadora.data.materiales);
  var iding=(window.secadora.data.iding);
  var mat=[];
  var aux=0;
  for (var i = 0; i < materiales.length; i++) {
    if(materiales[i].estado=="TRUE"){
      aux=1;
      var m=[];
      m[0]=materiales[i].idDetalle;
      mat.push(m);
    }
  }
  if (aux=='0') {
    $('#contenidoWarning').text('No seleccionó ningun material para la carga');
    $("#alertWarning").modal('show');
  }else{
    var options={
      type : 'post',
      url : 'index.php?c=ctrCargaSecadora&a=registroCargaSecMan',
      data: {
        'iding' : iding,
        'materiales' : mat
      },
    };
    $.ajax(options).done(function(data){
      if(data==1){
        $('#contenidoExito').text('Registro Correcto!!');
        $("#alertExito").modal('show');
      }else{
        $('#contenidoError').text('Error al Insertar!!');
        $("#alertError").modal('show');
      }
    })
  }

}

function redireccionar() {
  location.reload(true);
}
