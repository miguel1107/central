function ver(id){
  window.ultrazonica.llenatabla(id);
}

function verCarga(id){
  window.ultrazonica.llenavercarga(id);
  $("#ver_carga").modal('show');
}

function llenaCargaUl(){
  window.ultrazonica.llenaCarga();
  $("#modal-table").modal('hide');
}

function eliminaCarga(id) {
  for (var i = 0; i < window.ultrazonica.data.materiales.length; i++) {
    if (window.ultrazonica.data.materiales[i].estado=='TRUE') {
      if (window.ultrazonica.data.materiales[i].idDetalle==id) {
        window.ultrazonica.data.materiales[i].estado='FALSE';
        window.ultrazonica.llenaCarga();
      }
    }
  }
}

function registroCarga() {
  var materiales=(window.ultrazonica.data.materiales);
  //var iding=(window.ultrazonica.data.iding);
  var mat=[];
  var ultra=$('#ultrazonica').val();
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
  console.log(mat);
  if(ultra=='0'){
    $('#contenidoWarning').text('Escoja una ultrazonica');
    $("#alertWarning").modal('show');
  }else if (aux==0) {
    $('#contenidoWarning').text('No selecciono ningun material para la carga');
    $("#alertWarning").modal('show');
  }else{
    var options={
      type : 'post',
      url : 'index.php?c=ctrCargaUltrazonica&a=registraCarga',
      data: {
        'ultra' : ultra,
        //'iding' : iding,
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
    });
  }
}

function desocupaUltrazonica(id) {
  var options={
    type : 'post',
    url : 'index.php?c=ctrCargaUltrazonica&a=descargarUltrazonica',
    data: {
      'idultra' : id
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

function redireccionar() {
  location.reload(true);
}
