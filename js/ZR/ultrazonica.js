function ver(id){
  $("#modal-table").modal('show');
  window.ultrazonica.llenatabla(id);
}

function llenaCargaUl(){
  window.ultrazonica.llenaCarga();
  $("#modal-table").modal('hide');
}

function desocupaUltrazonica(id) {
  alert(id);
}
