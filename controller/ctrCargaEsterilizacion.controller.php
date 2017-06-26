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

  //carga esterilizador
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
  //descarga esterilizador
  public function listaDescarga(){
    $ideste=$_POST['idEste'];
    $cargaeste=new cargaEsterilizacion();
    $im=new ingresoMaterial();
    $ls=$cargaeste->retornaDetalleDescargar($ideste);
    $retur= array();
    foreach ($ls as $key) {
      $aux = array();
      $iding=$key->id_ingreso;
      $prop=$key->tipo_propietario;
      $iddet=$key->id_detalle;
      $paquetes=$key->paquetes;
      $descmat=$key->descripcion;
      $piezas=$key->cantidad_material;
      $tipo=$key->tipo_ingreso;
      $idcarga=$key->id_carga;
      $ideste=$key->id_esterilizador;
      $ls2=$im->retornaRecpcionDetalleDescargaEste($iding,$prop);
      foreach ($ls2 as $key2) {
        $fecha=$key2->fecha;
        $descripcioning=$key2->descripcion;
        array_push($aux,$iding);
        array_push($aux,$prop);
        array_push($aux,$fecha);
        array_push($aux,$descripcioning);
        array_push($aux,$iddet);
        array_push($aux,$paquetes);
        array_push($aux,$descmat);
        array_push($aux,$piezas);
        array_push($aux,$tipo);
        array_push($aux,$idcarga);
        array_push($aux,$ideste);
      }
      array_push($retur,$aux);
    }
    echo json_encode($retur);

  }
}
?>
