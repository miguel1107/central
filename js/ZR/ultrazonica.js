function ver(id){
  $("#modal-table").modal('show');
  window.ultrazonica.llenatabla(id);
}

function llenaCargaUl(){
  window.ultrazonica.llenaCarga();
  $("#modal-table").modal('hide');
}

function registroCarga() {
  var materiales=(window.ultrazonica.data.materiales);
  var mat=[];
  var ultra=$('#ultrazonica').val();
  for (var i = 0; i < materiales.length; i++) {
    if(materiales[i].estado=="TRUE"){
      var m=[];
      m[0]=materiales[i].idDetalle;
      mat.push(m);
    }
  }
  var options={
    type : 'post',
    url : 'index.php?c=ctrCargaUltrazonica&a=registraCarga',
    data: {
      'ultra' : ultra,
      'materiales' : mat
    },
  };
  $.ajax(options).done(function(data){
    if(data==1){
      alert("REGISTRO CORRECTO");
      window.location="inicio.php?menu=cargaultrazonica2";
    }else{
      alert("ERROR AL INSERTAR");
    }
  })

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
      alert("DECARGA EXITOSA");
      window.location="inicio.php?menu=cargaultrazonica2";
    }else{
      alert("ERROR AL DESARGAR");
    }
  });
}
