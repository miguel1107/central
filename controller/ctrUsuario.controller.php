<?php

/**
 *
 */
require_once __DIR__.'/../model/usuario.php';

class ctrUsuario {

  function __construct(){
  }

  public function insertar(){
    $dni=$_REQUEST["dni"];
    $zona=$_REQUEST["zona"];
    $pas=md5($dni);
    $oUsuario= new Usuario();
    $a=$oUsuario->insertarUsuario($dni,$zona,$pas);
    if($a==true){
      header('Location: inicio.php?menu=usuarios');
    }
  }

  public function editar(){
    $estado=$_REQUEST["estado"];
    $id=$_REQUEST["id"];
    $zona=$_REQUEST["zona"];
    $oUsuario= new Usuario();
    $a=$oUsuario->actualizarUsuario($zona,$estado,$id);
    if( $a==true){
        header('Location: inicio.php?menu=usuarios');
    }
  }

  public function eliminar(){
    $usuario= $_REQUEST["idUs"];
    $oUsuario= new Usuario();
    $a=$oUsuario->eliminarUsuario($usuario);
    if( $a==true){
        header('Location: inicio.php?menu=usuarios');
    }
  }

  public function cambiaContra(){
    $pas=$_POST["pas"];
    $newpas=$_POST["npas"];
    header('Location: inicio.php');
    /*if($pas=$newpas){
      header('Location: inicio.php');
    }else{
      header('Location: login.php');
    }*/
  }


}

?>
