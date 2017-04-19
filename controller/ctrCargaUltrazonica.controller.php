<?php
require_once __DIR__.'/../model/cargaUltrazonica.php';
require_once __DIR__.'/../model/ultrazonica.php';
require_once __DIR__.'/../model/ingresoMaterial.php';

/**
 *
 */
class ctrCargaUltrazonica{

  function __construct(){
  }

  public function registraCarga(){
    $mat=$_POST['materiales'];
    $idultra=$_POST['ultra'];
    //$iding=$_POST['iding'];
    $l=count($mat);
    $ca=new cargaUltrazonica();
    $ul=new ultrazonica();
    //$ingmat=new ingresoMaterial();
    $rs=$ca->registroCarga($mat,$idultra);
    if($rs=="true"){
      $ul->actualizaEstado($idultra,'O');
      //$ingmat->entraSaleUltra($iding,'P');
      $rpta = array('estado' => "true", );
    }else{
      $rpta = array();
    }
    echo count($rpta);
  }

  public function descargarUltrazonica(){
    $idultra=$_POST['idultra'];
    $ul=new ultrazonica();
    $ca=new cargaUltrazonica();
    $ingmat=new ingresoMaterial();
    $det= new detalleIngMaterial();
    $ls=$ca->retornaDetalleDescargar($idultra);
    foreach ($ls as $l) {
      $iddetalle=$l->detalle;
      $rs=$ca->actulizaCarga($iddetalle);
      $rs2=$det->actualizaUltrazonica($iddetalle,'T');
    }
    $rs3=$ul->actualizaEstado($idultra,'D');
    if($rs=="true"){
      $rpta = array('estado' => "true", );
    }else{
      $rpta = array();
    }
    echo count($rpta);
  }

  public function verCarga(){
    $ultra=$_POST['id'];
    $ul=new ultrazonica();
    $rs=$ul->verCarga($ultra);
    echo json_encode($rs);
  }
}

?>
