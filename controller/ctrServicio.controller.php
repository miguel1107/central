<?php

require_once __DIR__.'/../model/servicio.php';
/**
 *
 */
class ctrServicio{

  function __construct(){
  }

  public function insertar(){
    $nom=$_REQUEST["nomServi"];
    $oServicio= new servicio();
    $a=$oServicio->insertarServicio($nom);
    if($a==true){
      header('Location: inicio.php?menu=servicios');
    }
  }

  public function modificar(){
    $nom=$_REQUEST["nomServiMod"];
    $id=$_REQUEST["idServiMod"];
    $oServicio= new servicio();
    $a=$oServicio->actualizarServicio($nom,$id);
    if($a==true){
    }
    header('Location: inicio.php?menu=servicios');
  }

  public function eliminar(){
    $idEli= $_REQUEST["idServiEli"];
    $oServicio= new servicio();
    $a=$oServicio->eliminarServicio($idEli);
    if( $a==true){
      header('Location: inicio.php?menu=servicios');
    }
  }


  public function autocomplete(){
    $filtroser = strtoupper($_REQUEST['term']);
    $newser = '%'.$filtroser.'%';
    $em = new servicio();
    $listaser = $em->listasautocomplete($newser);

    foreach ($listaser as $key => $val) {
      $val->label = $val->nombre;
    }

    echo json_encode($listaser);
  }
}

 ?>
