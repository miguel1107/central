<?php
require_once __DIR__.'/../model/detalleset.php';

/**
 *
 */
class ctrDetalleset{

  function __construct(){
  }

  public function imprimeTable(){
    $det=new detalleSet();
    $id=$_POST["id"];
    $listadet=$det->listadoDetalleset($id);
    require 'view/html/tabladetalleset.php';
  }
}




 ?>
