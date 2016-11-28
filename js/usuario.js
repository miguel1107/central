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
  var dni=$('#form-input-readonly').val();
  var pas=document.contra.pass.value;
  var pasn=document.contra.newpass.value;
  if (pas===pasn) {
    var options={
      type : 'post',
      url : 'index.php?c=ctrUsuario&a=cambiaContra',
      data : {
        'dni' : dni,
        'pas': pas,
        'npas':pasn
      }
    };
    $.ajax(options).done(function(msg){
      if(msg=='true'){
        alert("Cambio de contraseña exitoso");
        window.location="salir.php";
      }
    });
  }else{
    alert("Las contraseñas no coinciden");
  }

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
