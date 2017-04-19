<?php
require_once __DIR__.'/../model/cargaSecadora.php';
require_once __DIR__.'/../model/secadora.php';
require_once __DIR__.'/../model/ingresoMaterial.php';
require_once __DIR__.'/../model/detalleIngMaterial.php';//sec manual

class ctrCargaSecadora{

  function __construct(){
  }

  public function registraCargaSec(){
    $mat=$_POST['materiales'];
    $idsec=$_POST['secadora'];
    //$iding=$_POST['iding'];
    $csec=new cargaSecadora();
    $sec=new secadora();
    //$ingmat=new ingresoMaterial();
    $rs=$csec->registroCargaSec($mat,$idsec);
    if($rs=="true"){
      $rs2=$sec->actualizaEstadoSec($idsec,'O');
      //$ingmat->entraSaleSec($iding,'P');
      $rpta = array('estado' => "true", );
    }else{
      $rpta = array();
    }
    echo count($rpta);
  }

  public function descargarSecadora(){
    $idsec=$_POST['idsec'];
    $sec=new secadora();
    $csec=new cargaSecadora();
    $ingmat=new ingresoMaterial();
    $det= new detalleIngMaterial();
    $ls=$csec->retornaDetalleDescargarSec($idsec);
    foreach ($ls as $l) {
      $iddetalle=$l->detalle;
      $rs=$csec->actulizaDescargaSec($iddetalle);
      $rs2=$det->actualizaDescargaSec($iddetalle);
    }
    $rs3=$sec->actualizaEstadoSec($idsec,'D');
    if($rs3="true"){
      $rpta = array('estado' => "true", );
    }else{
      $rpta = array();
    }
    echo count($rpta);
  }

  public function registroCargaSecMan(){
    $mat=$_POST['materiales'];
    $det=new detalleIngMaterial();
    $ingmat=new ingresoMaterial();
    //$iding=$_POST['iding'];
    $l=count($mat);
    $aux=0;
    for ($i=0; $i < $l ; $i++) {
      $iddet=$mat[$i][0];
      $iding=$mat[$i][1];
      $ingmat->entraSaleSec($iding,'P');
      $rs=$det->actualizaSecadoManual($iddet,'T');
      if($rs=="false"){
        $aux=1;
      }
    }
    if($aux==0){
      $rpta = array('estado' => "true", );
    }else{
      $rpta = array();
    }
    echo count($rpta);
  }

  public function verCarga(){
    $sec=$_POST['id'];
    $se=new secadora();
    $rs=$se->verCarga($sec);
    echo json_encode($rs);
  }
}

?>
