<?php
require_once "cado.php";
require_once __DIR__.'/../model/detalleIngMaterial.php';

/**
 *
 */
class cargaUltrazonica{

  private $objPDO;

  function __construct(){
    $this->objPDO = new cado();
  }

  public function registroCarga($materiales,$idultra){
    $mat=$materiales;
    $det=new detalleIngMaterial();
    $conexion=new cado();
		$conexion->conectar();
    $fecha=$this->fecha();
    $l=count($mat);
		$sql="INSERT INTO sisesterilizacion.carga_ultrazonica(id_detalle, fecha_carga, id_ultrazonica,estado) VALUES";
    for ($i=0; $i <$l ; $i++) {
      $iddet=$mat[$i][0];
      $det->actualizaUltrazonica($iddet);
      if($i==0){
        $stringInser="('".$iddet."','".$fecha."','".$idultra."','P')";
      }else{
        $stringInser=",('".$iddet."','".$fecha."','".$idultra."','P')";
      }
      $sql=$sql.$stringInser;
    }
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

  public function retornaMax($idultra){
    $conexion=new cado();
		$conexion->conectar();
    $sql="SELECT max(id_detalle) as carga FROM sisesterilizacion.carga_ultrazonica WHERE id_ultrazonica='".$idultra."'";
    $rs=pg_query($sql);
    if(pg_num_rows($rs)==1){
			if($row=pg_fetch_array($rs)){
				$iddetalle=$row['carga'];
			}
		}
    return $iddetalle;
  }

  public function actulizaDescarga($iddetalle){
    $conexion=new cado();
		$conexion->conectar();
    $fecha=$this->fecha();
		$sql="UPDATE sisesterilizacion.carga_ultrazonica SET fecha_descarga='".$fecha."' , estado= 'T' WHERE id_detalle='".$iddetalle."';";
		$rs=pg_query($sql) or die(false);
		if($rs=true){
      return "true";
    }else{
      return "false";
    }
  }
}


?>
