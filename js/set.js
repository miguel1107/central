/*$("#selectTipo").change(function(){
    var w=$("#selectTipo").val();
    $("#idset").val(w);
    var options={
      type:'POST',
      url:'index.php?c=ctrDetalleset&a=imprimeTable',
      data: {
          'id':w
      },
      dataType:'html',
      success:function(response){
          ajax_resultado.html('');
          ajax_resultado.html(response);
          ajax_resultado.show();
      }
    };
    $.ajax(options);}

  });
  $(document).ready(function(){
    $("#modi").submit(function(){
      return $(this).validate();
    });
  });

  $(document).on('click', '#nuevo-set', function(){
    $("#newSet").modal('show');
  });
  */
var ajax_resultado=$('#tabladet');
function llenatabla() {
  alert('ff');
}


function editarSet(idmat,idset){
  $("#modiSet").modal('show');
  $("#idmat").val(idmat);
  $("#idset").val(idset);
}
