function ver(id){
  //$("#modal-table").modal('show');
  window.empaque.llenatabla(id);
  //window.empaque.llenaCarga();
}

function empacar(id,cant,aux) {
  $("#emp").modal('show');
  var t=window.empaque.data.materiales[aux].tipo;
  var iding=window.empaque.data.materiales[aux].iding;
  window.empaque.llenaparaempacar(id,cant,t,iding);
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

function cancelar() {
  window.empaque.cancelar();
}

function verMat(id) {
  var tip=window.empaque.data.materiales[id].tipo;
  if (tip=='Mat') {
  }else if(tip=='Set'){
    var det=window.empaque.data.materiales[id].idset;
    $("#modal-table").modal('show');
    window.empaque.llenaDetalle(det,tip);
  }else if (tip=='Kit') {
    var det=window.empaque.data.materiales[id].idkit;
    $("#modal-table").modal('show');
    window.empaque.llenaDetalle(det,tip);
  }
}

function registroEmpaque() {
  var cantidad=$('#cantEmapacar').val();
  var emp=$('#cantEmp').val();
  var env=$('#envoltura').val();
  var tipo=$('#ti').val();
  var iddt=$('#iddetalleMod').val();
  var ing=$('#idingreso').val();
  console.log(ing);
  console.log(emp+'-'+cantidad+'-'+env+'-'+tipo+'-'+iddt);
  if (cantidad=='' || cantidad=='0') {
    alert('ERROR: INGRESE CANTIDAD QUE DESEE EMPACAR');
    $('#cantEmapacar').val('');
    $('#cantEmapacar').focus();
  }else{
    var options={
      type: 'post',
      url : 'index.php?c=ctrEmpaque&a=registraEmpaque',
      data: {
        'cantidad': cantidad,
        'emp': emp,
        'env': env,
        'tipo': tipo,
        'iddt': iddt
      }
    };
    $.ajax(options).done(function (data) {
      if(data==1){
        // $('#contenidoExito').text('Empaque Correcto!!');
        // $("#alertExito").modal('show');
        alert('Empaque Existoso');
        $("#emp").modal('hide');
        window.empaque.llenatabla(ing);
      }else{
        alert('Error al Empacar');
        $("#emp").modal('hide');
        // $('#contenidoError').text('Error al Empacar!!');
        // $("#alertError").modal('show');
      }
    });
  }
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
