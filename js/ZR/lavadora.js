function ver(id){
  $("#modal-table").modal('show');
  window.lavadora.llenatabla(id);
}

function llenaCargaLav(){
  window.lavadora.llenaCarga();
  $("#modal-table").modal('hide');
}

function registroCarga(){
  var materiales=(window.lavadora.data.materiales);
  var iding=(window.lavadora.data.iding);
  var mat=[];
  var lavadora=$('#lavadora').val();
  var tipo=$('#lavadoraTipo').val();
  for (var i = 0; i < materiales.length; i++) {
    if(materiales[i].estado=="TRUE"){
      var m=[];
      m[0]=materiales[i].idDetalle;
      mat.push(m);
    }
  }
  var options={
    type : 'post',
    url : 'index.php?c=ctrCargaLavadora&a=registraCargaLav',
    data: {
      'tipo' : tipo,
      'iding' : iding,
      'lavadora' : lavadora,
      'materiales' : mat
    },
  };
  $.ajax(options).done(function(data){
    if(data==1){
      alert("REGISTRO CORRECTO");
      window.location="inicio.php?menu=cargaLavadora";
    }else{
      alert("ERROR AL INSERTAR");
    }
  })

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
      alert("DECARGA EXITOSA");
      window.location="inicio.php?menu=cargaLavadora";
    }else{
      alert("ERROR AL DESARGAR");
    }
  });
}
