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
