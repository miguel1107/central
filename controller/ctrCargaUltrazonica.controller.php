<?php
require_once __DIR__.'/../model/cargaUltrazonica.php';
require_once __DIR__.'/../model/ultrazonica.php';

/**
 *
 */
class ctrCargaUltrazonica{

  function __construct(){
  }

  public function registraCarga(){
    $mat=$_POST['materiales'];
    $idultra=$_POST['ultra'];
    $l=count($mat);
    $ca=new cargaUltrazonica();
    $ul=new ultrazonica();
    $rs=$ca->registroCarga($mat,$idultra);
    if($rs=="true"){
      $rs2=$ul->actualizaEstado($idultra,'O');
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
    $rs=$ul->actualizaEstado($idultra,'D');
    if($rs="true"){
      $iddetalle=$ca->retornaMax($idultra);
      $rs2=$ca->actulizaDescarga($iddetalle);
      if($rs2=="true"){
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
