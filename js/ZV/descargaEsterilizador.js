function ver(id) {
  window.descargaEsterilizador.llenaCarga(id);
}

function abreModal(cadena) {
  var re=cadena.split(",");
  var idcarga=re[0];
  var i=re[1];
  var det=re[2];
  var empaques=window.descargaEsterilizador.data.carga[i].paquetes;
  $("#rees").modal('show');
  $("#idcargaeste").val(idcarga);
  $("#cantEmp").val(empaques);
  $("#cantRees").val("");
  $("#position").val(i);
  $("#iddetalle").val(det);
}

function reseet() {
  var idcargaeste=$("#idcargaeste").val();
  var empaques=$("#cantEmp").val();
  var cantrees=$("#cantRees").val();
  var cantnorees=empaques-cantrees;
  var iddet=$("#iddetalle").val();
  var position=$("#position").val();
  $("#rees").modal('hide');
  window.descargaEsterilizador.reesterilizar(idcargaeste,cantrees,cantnorees,position,iddet);
}

function terminar() {
  window.descargaEsterilizador.terminardescarga();
}

$(document).ready(function() {
  $('#cantRees').blur(function() {
    var emp=parseInt($('#cantEmp').val(),"10");
    var cant=parseInt($('#cantRees').val(),"10");
    if (cant>emp || cant==0) {
      alert('ERROR: la cantidad de empaques no es correcta');
      $('#cantRees').val('');
      $('#cantRees').focus();
    }
  });
});
