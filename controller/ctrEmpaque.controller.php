<?php


require_once __DIR__.'/../model/empaquetado.php';
require_once __DIR__.'/../model/detalleIngMaterial.php';
/**
 *
 */
class ctrEmpaque{

  function __construct(){
  }

  public function registraEmpaque(){
    $cantidad=$_POST['cantidad'];
    $emp=$_POST['emp'];
    $env=$_POST['env'];
    $tipo=$_POST['tipo'];
    $iddt=$_POST['iddt'];
    $empaquetado=new empaquetado();
    $detmat=new detalleIngMaterial();
    $rs=$empaquetado->registrar($cantidad,$env,$tipo,$iddt);
    if ($rs=="true") {
      $faltaemp=$emp-$cantidad;
      $rs1=$detmat->actualizaEmpaquetado($iddt,$faltaemp);
      if ($rs1=="true") {
          $rpta = array('estado' => true, );
      }else{
        $rpta = array();
      }
    }else{
      $rpta = array();
    }
    echo count($rpta);
  }

}

?>
