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

  var materiales=JSON.stringify(window.IngresoMaterial.data.materiales);
  alert();
  /*for (var i in materiales) {
  mat.push([i,materiales[i]]);
  }
  for (var i = 0; i < mat.length; i++) {
  alert(mat[i]);
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
    alert(msg);
  });
  //alert(materiales)
}
