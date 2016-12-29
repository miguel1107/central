<?php
  require_once __DIR__.'/../model/detalleIngMaterial.php';
  /**
   *
   */
  class ctrDetalleIngresoMaterial{

    function __construct(){
    }

    public function retornaDetalleRecion(){
      $id=$_POST['id'];
      $dim=new detalleIngMaterial();
      $rs=$dim->retornaDetalle($id);
      echo json_encode($rs);
    }

    public function retornaDetalleLav(){
      $id=$_POST['id'];
      $dim=new detalleIngMaterial();
      $rs=$dim->retornaDetalleLav($id);
      echo json_encode($rs);
    }

    public function retornaDetalleSec(){
      $id=$_POST['id'];
      $dim=new detalleIngMaterial();
      $rs=$dim->retornaDetalleSec($id);
      echo json_encode($rs);
    }
  }

?>
