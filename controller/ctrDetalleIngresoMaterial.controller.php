<?php
  require_once __DIR__.'/../model/detalleIngMaterial.php';
  /**
   *
   */
  class ctrDetalleIngresoMaterial{

    function __construct(){
    }

    //ZR
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

    //ZA
    public function retornaDetalleEmpaquetado(){
      $id=$_POST['id'];
      $dim=new detalleIngMaterial();
      $rs=$dim->retornaDetalleEmp($id);
      echo json_encode($rs);
    }

    public function retornaDetalleCargaesterilizacion(){
      $id=$_POST['id'];
      $este=$_POST['tipo'];
      $dim=new detalleIngMaterial();
      $rs=$dim->retornaDetalleEste($id,$este);
      echo json_encode($rs);
    }

  }

?>
