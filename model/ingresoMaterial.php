<?php
require_once "cado.php";

/**
 *
 */
class ingresoMaterial{
  private $objPDO;

  function __construct(){
    $this->objPDO = new cado();
  }

  public function registrarServicio($idIngresa,$idRecibe,$total,$tipoPro,$idServicio){
    $conexion=new cado();
		$conexion->conectar();
		$sql="INSERT INTO sisesterilizacion.ingreso_material(fecha_ingreso,id_ingresa,id_recibe,total_piezas,estado,tipo_propietario,id_servicio,ubicacion) VALUES ('current_timestamp','$idIngresa','$idRecibe','$total','P','S','$idServicio','REC');";
		$rs=pg_query($sql) or die(false);
		return $rs;
  }

}

 ?>
