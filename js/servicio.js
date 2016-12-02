function nuevo() {
  $("#servicioNuevo").modal('show');
}

function editar(ser){
  $("#modalModificar").modal('show');
  $("#idServiMod").val(ser);
}


function eliminar(ser){
  $("#modalEliminar").modal('show');
  $("#idServiEli").val(ser);
}
