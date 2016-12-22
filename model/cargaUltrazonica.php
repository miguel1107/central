<?php
require_once "cado.php";

/**
 *
 */
class cargaULtrazonica{

  private $objPDO;

  function __construct(){
    $this->objPDO = new cado();
  }

  public function registroCarga(){
    $conexion=new cado();
		$conexion->conectar();
		$sql="INSERT INTO sisesterilizacion.carga_ultrazonica(id_detalle, fecha_carga, id_ultrazonica,estado) VALUES (?, ?, ?, ?);";
		$rs=pg_query($sql) or die(false);
		return $rs;
  }
}


?>
