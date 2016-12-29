function ver(id){
  $("#modal-table").modal('show');
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
  var secadora=$('#secadora').val();
  for (var i = 0; i < materiales.length; i++) {
    if(materiales[i].estado=="TRUE"){
      var m=[];
      m[0]=materiales[i].idDetalle;
      mat.push(m);
    }
  }
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
      alert("REGISTRO CORRECTO");
      window.location="inicio.php?menu=cargaSecadora";
    }else{
      alert("ERROR AL INSERTAR");
    }
  })

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
      alert("DECARGA EXITOSA");
      window.location="inicio.php?menu=cargaSecadora";
    }else{
      alert("ERROR AL DESARGAR");
    }
  });
}

function registroSecManual(){
  var materiales=(window.secadora.data.materiales);
  var iding=(window.secadora.data.iding);
  var mat=[];
  for (var i = 0; i < materiales.length; i++) {
    if(materiales[i].estado=="TRUE"){
      var m=[];
      m[0]=materiales[i].idDetalle;
      mat.push(m);
    }
  }
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
      alert("REGISTRO CORRECTO");
      window.location="inicio.php?menu=secadoManual";
    }else{
      alert("ERROR AL INSERTAR");
    }
  })

}
