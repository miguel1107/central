<?php
  require_once __DIR__.'/../model/detalleset.php';

  /**
   *
   */
  class ctrDetalleset{

    function __construct(){
    }

    public function retornaDetalleSet(){
      $det=new detalleSet();
      $id=$_POST["id"];
      $rs=$det->listadoDetalleset($id);
      echo json_encode($rs);
    }
  }



?>
