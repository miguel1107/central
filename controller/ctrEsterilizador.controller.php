<?php
require_once __DIR__.'/../model/esterilizador.php';

/**
 *
 */
class ctrEsterilizador{

  function __construct(){
  }

  public function llenaCombo(){
    $tipo=$_POST['este'];
    $este=new esterilizador();
    $rs=$este->cargaCombo($tipo);
    $r= "<option value='0'>SELECCIONE ESTERILIZADOR</option>";
    foreach ($rs as $ls) {
      $r=$r."<option value='".$ls->id_esterilizador."'>". $ls->descripcion."</option>";
    }
    echo $r;
  }

}
?>
