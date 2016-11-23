/*$(document).on('click', '#nuevo_servicio', function(){
  $("#servicioNuevo").modal('show');
});

$(document).ready(function(){
  $("#test").submit(function(){
      return $(this).validate();
  });
});

$(document).ready(function(){
  $("#eli").submit(function(){
      return $(this).validate();
  });
});
$(document).ready(function(){
  $("#modi").submit(function(){
      return $(this).validate();
    });
});
*/


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
