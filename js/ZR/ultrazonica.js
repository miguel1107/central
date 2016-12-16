/*function ver(id){
  var $ifr = $('#iframemodal');
  $('#iframemodal').attr('src', '/central/view/html/ZR/tabla.php?id='+id);

  $("#modal-table").modal('show');
  /*$ifr.ready(function(){
    var $boton = $ifr.contents().find('#cerrariframe');
    $boton.click(function(){
      console.log('hizo click');
    });
  });*/


function ver(id){
  $("#modal-table").modal('show');
  window.ultrazonica.llenatabla(id);
}

function enviarr(){
  window.ultrazonica.llenaCarga();
  $("#modal-table").modal('hide');
}
