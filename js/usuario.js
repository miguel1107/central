$().ready(function() {
    $("#nomusuario").autocomplete({
      source: 'index.php?c=ctrempleado&a=autocomplete',
      select: function(event, ui) {
        event.preventDefault();
        $('#nomusuario').val(ui.item.nombres);
        $('#dni').val(ui.item.emp_dni);
      },
    });
});

$(document).on('click', '#config',function() {
  var pas=document.contra.pass.value;
  var pasn=document.contra.newpass.value;
  var options={
    type : 'post',
    url : 'index.php?c=ctrUsuario&a=cambiaContra',
    data : {
      'pas': pas,
      'npas':pasn
    }
  };
  $.ajax(options);
});


$(document).on('click', '#nuevo_usuario', function(){
  $("#modalNuevo").modal('show');
});

$(document).ready(function(){
  $("#modi").submit(function(){
      return $(this).validate();
    });
});

$(document).ready(function(){
  $("#modalNuevo").submit(function(){
      return $(this).validate();
  });
});

$(document).ready(function(){
  $("#modalEliminar").submit(function(){
    return $(this).validate();
  });
});

function eliminar(id){
  $("#modalEliminar").modal('show');
  $("#idUs").val(id);
}
function editar(id){
      $("#modalModificar").modal('show');
      $("#id").val(id);
}
