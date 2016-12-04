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

  public function registrarServicio($idIngresa,$idRecibe,$total,$idServicio){
    $conexion=new cado();
		$conexion->conectar();
    $fecha=$this->fecha();
		$sql="INSERT INTO sisesterilizacion.ingreso_material(id_ingresa,id_recibe,total_piezas,estado,tipo_propietario,id_servicio,ubicacion,fecha_ingreso) VALUES ('$idIngresa','$idRecibe','$total','P','S','$idServicio','REC','$fecha');";
		$rs=pg_query($sql) or die(false);
		return $rs;
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

  public function retornaId(){
    $conexion=new cado();
		$conexion->conectar();
    $sql="SELECT max(id_ingreso) as recepcion from sisesterilizacion.ingreso_material";
    $rs=pg_query($sql);
    if(pg_num_rows($rs)==1){
			if($row=pg_fetch_array($rs)){
				$id=$row[0];
			}
		}
    return $id;
  }


}

 ?>
