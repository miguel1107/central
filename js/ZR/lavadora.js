function ver(id){
  window.lavadora.llenatabla(id);
}

function llenaCargaLav(){
  window.lavadora.llenaCarga();
  $("#modal-table").modal('hide');
}

function verCarga(id){
  window.lavadora.llenavercarga(id);
  $("#ver_carga").modal('show');
}

function cancelar() {
  window.lavadora.cancelar();
}

function eliminaCarga(id) {
  for (var i = 0; i < window.lavadora.data.materiales.length; i++) {
    if (window.lavadora.data.materiales[i].estado=='TRUE') {
      if (window.lavadora.data.materiales[i].idDetalle==id) {
        window.lavadora.data.materiales[i].estado='FALSE';
        window.lavadora.llenaCarga();
      }
    }
  }
}

function selecciongeneral() {
  window.lavadora.selecciongeneral();
}

function registroCarga(){
  var materiales=(window.lavadora.data.materiales);
  //var iding=(window.lavadora.data.iding);
  var mat=[];
  var aux=0;
  var lavadora=$('#lavadora').val();
  var tipo=$('#lavadoraTipo').val();
  for (var i = 0; i < materiales.length; i++) {
    if(materiales[i].estado=="TRUE"){
      aux=1;
      var m=[];
      m[0]=materiales[i].idDetalle;
      m[1]=materiales[i].id;
      mat.push(m);
    }
  }
  if (aux==0) {
    $('#contenidoWarning').text('No seleccionó ningun material para la carga');
    $("#alertWarning").modal('show');
  }else if(lavadora=='0'){
    $('#contenidoWarning').text('Escoja Lavadora');
    $("#alertWarning").modal('show');
  }else if (tipo=='0') {
    $('#contenidoWarning').text('Escoja tipo de proceso');
    $("#alertWarning").modal('show');
  }
  else{
    var options={
      type : 'post',
      url : 'index.php?c=ctrCargaLavadora&a=registraCargaLav',
      data: {
        'tipo' : tipo,
        //'iding' : iding,
        'lavadora' : lavadora,
        'materiales' : mat
      },
    };
    $.ajax(options).done(function(data){
      if(data==1){
        $('#contenidoExito').text('Registro Existoso!!');
        $("#alertExito").modal('show');
      }else{
        $('#contenidoError').text('Error al insertar!!');
        $("#alertError").modal('show');
      }
    })
  }
}

function desocupaLavadora(id) {
  var options={
    type : 'post',
    url : 'index.php?c=ctrCargaLavadora&a=descargarLavadora',
    data: {
      'idlav' : id
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
  });
}

function registroLavManual(){
  var materiales=(window.lavadora.data.materiales);
  //var iding=(window.lavadora.data.iding);
  var mat=[];
  var aux=0;
  for (var i = 0; i < materiales.length; i++) {
    if(materiales[i].estado=="TRUE"){
      aux=1;
      var m=[];
      m[0]=materiales[i].idDetalle;
      m[1]=materiales[i].id;
      mat.push(m);
    }
  }
  if (aux==0) {
    $('#contenidoWarning').text('No seleccionó ningun material para la carga');
    $("#alertWarning").modal('show');
  }else{
    var options={
      type : 'post',
      url : 'index.php?c=ctrCargaLavadora&a=registroCargaLavMan',
      data: {
        //'iding' : iding,
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
