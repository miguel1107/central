<?php
require_once __DIR__.'/../model/cargaLavadora.php';
require_once __DIR__.'/../model/lavadora.php';
require_once __DIR__.'/../model/ingresoMaterial.php';

/**
 *
 */
class ctrCargaLavadora{

  function __construct(){
  }

  public function registraCargaLav(){
    $mat=$_POST['materiales'];
    $tipo=$_POST['tipo'];
    $idLav=$_POST['lavadora'];
    $iding=$_POST['iding'];
    $l=count($mat);
    $cla=new cargaLavadora();
    $lav=new lavadora();
    $ingmat=new ingresoMaterial();
    $rs=$cla->registroCargaLav($mat,$idLav,$tipo);
    if($rs=="true"){
      $rs2=$lav->actualizaEstado($idLav,'O');
      $ingmat->entraSaleLav($iding,'P');
      $rpta = array('estado' => "true", );
    }else{
      $rpta = array();
    }
    echo count($rpta);
  }

  public function descargarLavadora(){
    //aqui me quede
    $idlav=$_POST['idlav'];
    $lav=new lavadora();
    $ca=new cargaLavadora();
    $ingmat=new ingresoMaterial();
    $det= new detalleIngMaterial();
    $ls=$ca->retornaDetalleDescargar($idlav);
    foreach ($ls as $l) {
      $iddetalle=$l->detalle;
      $rs=$ca->actulizaDescargaLav($iddetalle);
      $rs2=$det->actualizaDescarga($iddetalle);
    }
    $rs3=$lav->actualizaEstado($idlav,'D');
    if($rs3="true"){
      $rpta = array('estado' => "true", );
    }else{
      $rpta = array();
    }
    echo count($rpta);
  }

}
?>
