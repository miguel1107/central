<?php
session_start();
require_once "cado.php";

/**
 *
 */
class reesterilizacion{
  private $objPDO;

  function __construct(){
    $this->objPDO = new cado();
  }

  public function registrar($idcargaeste,$paquetes){
    $conexion=new cado();
		$conexion->conectar();
    $idusu=$_SESSION["idusuario"];
    $fecha=$this->fecha();
    $sql="INSERT INTO sisesterilizacion.reesterilizacion(fecha, id_usu, paquetes,id_carga_este)  VALUES ('".$fecha."', '".$idusu."','".$paquetes."','".$idcargaeste."');";
    $rs=pg_query($sql) or die(false);
    if($rs==true){
      return "true";
    }else{
      return "false";
    }
  }

  public function fecha(){
    $conexion=new cado();
    $conexion->conectar();
    $sql="SELECT TIMESTAMP 'now'";
    $rs=pg_query($sql);
    if(pg_num_rows($rs)==1){
      if($row=pg_fetch_array($rs)){
        $fecha=$row[0];
      }
    }
    return $fecha;
  }

}

?>
