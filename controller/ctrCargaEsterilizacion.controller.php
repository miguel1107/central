<?php
require_once __DIR__.'/../model/cargaEsterilzacion.php';
require_once __DIR__.'/../model/esterilizador.php';
require_once __DIR__.'/../model/ingresoMaterial.php';
require_once __DIR__.'/../model/detalleIngMaterial.php';

/**
 *
 */
class ctrCargaEsterilizacion{

  function __construct(){
  }

  public function registroCarga(){
    $mat=$_POST['materiales'];
    $ideste=$_POST['maquina'];
    $cargaeste=new cargaEsterilizacion();
    $esteriliza=new esterilizador();
    $rs=$cargaeste->registroCarga($mat,$ideste);
    if ($rs=="true") {
      $rs2=$esteriliza->actualizaEsterilizador($ideste,'O');
      $rpta = array('estado' => "true" );
    }else{
      $rpta = array();
    }
    echo count($rpta);
  }

  public function actualizaCargaEsteTotal(){
    $ingmat=new ingresoMaterial();
    $ingmat->inicioCargaCargaEste();
  }
}
?>
