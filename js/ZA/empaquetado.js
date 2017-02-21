function ver(id){
  $("#modal-table").modal('show');
  window.empaque.llenatabla(id);
}

function cancelar() {
  window.empaque.cancelar();
}

function llenaCargaEmp(){
  window.empaque.llenaCarga();
  $("#modal-table").modal('hide');
}
