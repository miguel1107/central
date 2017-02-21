$().ready(function(){
  llenaCombo();
    function llenaCombo(){
      var data={
        'accion'='combo'
      };
      $.post("controller/crtMatQui.php",data,function(data_devuelta){
        $(#selecTipo).html(data_devuelta);
      });
    }
});
