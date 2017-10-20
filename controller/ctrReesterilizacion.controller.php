<?php
require_once __DIR__.'/../model/reesterilizacion.php';
require_once __DIR__.'/../model/cargaEsterilzacion.php';
require_once __DIR__.'/../model/detalleIngMaterial.php';


/**
 *
 */
class ctrReesterilizacion{

  function __construct(){
  }

  //carga esterilizador
  public function reseet(){
    $idcargaeste=$_POST['idcargaeste'];
    $cantrees=$_POST['cantrees'];
    $cantnorees=$_POST['cantnorees'];
    $iddet=$_POST['iddet'];
    $reesterilizacion=new reesterilizacion();
    $cargaeste= new cargaEsterilizacion();
    $dim=new detalleIngMaterial();
    $rs=$reesterilizacion->registrar($idcargaeste,$cantrees);
    if ($rs=="true") {
      if ($cantnorees==0) {
        $estado='R';
      }else if($cantnorees>0){
        $estado='P';
      }
      //actualiza la carga del esterilizador
      $rs2=$cargaeste->actulizaDescarga($idcargaeste,$estado,$cantnorees);
      //actualiza el detella de ingreso
      $rs3=$dim->actualizaReesterilizacion($cantrees,$iddet);
      $rpta = array('estado' => "true" );
    }else{
      $rpta = array();
    }
    echo count($rpta);
  }
}
?>
