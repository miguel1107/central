<?php
  require_once __DIR__.'/../model/detalleKit.php';

  /**
   *
   */
  class ctrDetallekit{

    function __construct(){
    }

    public function retornaDetalleKit(){
      $det=new detalleKit();
      $id=$_POST["id"];
      $rs=$det->listadoDetallekit($id);
      echo json_encode($rs);
    }
  }



?>
