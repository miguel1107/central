$(document).on('click', '#kit', function(){
  $("#nuevo_kit").modal('show');
});

function suma(a){
  var suma = 0;
  $("input[name='"+a+"[]']").each(function(i){
    if(isNaN(parseInt($(this).val()))){
      var a = 0;
    }else{
      var  a = parseFloat($(this).val());
    }
    suma += a;
  });
  return suma;
}

function soloNumeros(evt) {
  evt = (evt) ? evt : window.event;
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
    return false;
  }else{
    return true;
  }
}


function enviar(){
  var elem={
    tipo:$('#nombreKit').val(),
    cantidad:$('#cantidad').val()
  };
  window.IngresoMaterial.addKit(elem);
  $("#nuevo_kit").modal('hide');
}

function guardarServicio(){
  var id=$('#idempleado').val();
  var idrec=$('#idrecibe').val();
  var idserv=$('#idservicio').val();

  var materiales=(window.IngresoMaterial.data.materiales);
  alert(materiales[0].id);
  /*var mat=[][];
  for (var i = 0; i < materiales.length; i++) {
    mat[i][0]=materiales[i].tipo;
    mat[i][1]=materiales[i].tipo;
  }*/
  var options={
    type : 'post',
    url : 'index.php?c=ctrIngresoMaterial&a=regIngresoMaterial',
    data: {
      'id' : id,
      'idrec' : idrec,
      'idserv' : idserv,
      'materiales' : materiales
    },
  };
  $.ajax(options).done(function(msg){
    //alert(msg);
  });
  //alert(materiales)
}
