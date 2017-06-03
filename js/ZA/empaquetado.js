function ver(id){
  //$("#modal-table").modal('show');
  window.empaque.llenatabla(id);
  //window.empaque.llenaCarga();
}

function empacar(id,cant) {
  $("#emp").modal('show');
  window.empaque.llenaparaempacar(id,cant);
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
  var ingreso=window.empaque.data.materiales;
  for (var i = 0; i < ingreso.length; i++) {
    if (id==i) {
      var tip=window.empaque.data.materiales[i].tipo;
      if (tip=='Mat') {
      }else if(tip=='Set'){
        var det=window.empaque.data.materiales[i].idset;
        $("#modal-table").modal('show');
        window.empaque.llenaDetalle(det,tip);
      }else if (tip=='Kit') {
        var det=window.empaque.data.materiales[i].idkit;
        $("#modal-table").modal('show');
        window.empaque.llenaDetalle(det,tip);
      }
    }
  }
}
