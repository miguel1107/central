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
		$sql="INSERT INTO sisesterilizacion.ingreso_material(id_ingresa,id_recibe,total_piezas,estado,tipo_propietario,ubicacion,fecha_ingreso,id_servicio) VALUES ('$idIngresa','$idRecibe','$total','P','S','REC','$fecha','$idServicio');";
		$rs=pg_query($sql) or die(false);
    if ($rs==true) {
      return "true";
    }else{
      return "false";
    }
  }

  public function registrarMedico($idIngresa,$idRecibe,$total){
    $conexion=new cado();
		$conexion->conectar();
    $fecha=$this->fecha();
		$sql="INSERT INTO sisesterilizacion.ingreso_material(id_ingresa,id_recibe,total_piezas,estado,tipo_propietario,ubicacion,fecha_ingreso) VALUES ('$idIngresa','$idRecibe','$total','P','M','REC','$fecha');";
		$rs=pg_query($sql) or die(false);
		return $rs;
  }

  public function registrarTerceros($idRecibe,$total,$cen,$res){
    $conexion=new cado();
		$conexion->conectar();
    $fecha=$this->fecha();
		$sql="INSERT INTO sisesterilizacion.ingreso_material(id_recibe,total_piezas,estado,tipo_propietario,centro_procedencia,responsable,ubicacion,fecha_ingreso) VALUES ('$idRecibe','$total','P','T','$cen','$res','REC','$fecha');";
		$rs=pg_query($sql) or die(false);
	  return $rs;
  }

  public function registrarCasaComercial($idRecibe,$total,$res,$cen){
    $conexion=new cado();
		$conexion->conectar();
    $fecha=$this->fecha();
		$sql="INSERT INTO sisesterilizacion.ingreso_material(id_recibe,total_piezas,estado,tipo_propietario,responsable,centro_medico,ubicacion,fecha_ingreso) VALUES ('$idRecibe','$total','P','C','$res','$cen','REC','$fecha');";
		$rs=pg_query($sql) or die(false);
	  return $rs;
  }

  public function listaRecepcionesDisponibles(){
    $stmt = $this->objPDO->prepare("SELECT id_ingreso,tipo_propietario FROM sisesterilizacion.ingreso_material order by fecha_ingreso");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
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

  public function retornaRecpcion($id,$prop){
    if ($prop=='S') {
      $stmt = $this->objPDO->prepare("SELECT fecha_ingreso as fecha,tipo_propietario as prop,nombre_servicio as descripcion FROM sisesterilizacion.ingreso_material im inner join sisesterilizacion.servicio on im.id_servicio=sisesterilizacion.servicio.id_servicio where ubicacion='REC'  and id_ingreso='".$id."'; ");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
    if($prop=='M'){
      $stmt = $this->objPDO->prepare("SELECT fecha_ingreso as fecha,tipo_propietario as prop,(emp_appaterno||' '|| emp_apmaterno||','|| emp_nombres) as descripcion FROM sisesterilizacion.ingreso_material im inner join empleados em on em.emp_id=im.id_ingresa where ubicacion='REC' and id_ingreso='".$id."'");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
    if($prop=='T'){
      $stmt = $this->objPDO->prepare("SELECT fecha_ingreso as fecha,tipo_propietario as prop,(centro_procedencia||'->'||responsable) as descripcion FROM sisesterilizacion.ingreso_material where ubicacion='REC' and id_ingreso='".$id."'");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
    if($prop=='C'){
      $stmt = $this->objPDO->prepare("SELECT fecha_ingreso as fecha, tipo_propietario as prop,(responsable|| '->'||centro_medico) as descripcion FROM sisesterilizacion.ingreso_material where ubicacion='REC' and id_ingreso='".$id."'");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }


  }


}

 ?>
