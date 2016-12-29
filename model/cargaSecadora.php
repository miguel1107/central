<?php
require_once "cado.php";
require_once __DIR__.'/../model/detalleIngMaterial.php';

class cargaSecadora{

  private $objPDO;

  function __construct(){
    $this->objPDO = new cado();
  }

  public function registroCargaSec($materiales,$idSec){
    $mat=$materiales;
    $det=new detalleIngMaterial();
    $conexion=new cado();
		$conexion->conectar();
    $fecha=$this->fecha();
    $l=count($mat);
		$sql="INSERT INTO sisesterilizacion.carga_secadora(id_detalle, fecha_carga,id_secadora,estado) VALUES ";
    for ($i=0; $i <$l ; $i++) {
      $iddet=$mat[$i][0];
      $det->actualizaSecadora($iddet,'P');
      if($i==0){
        $stringInser="('".$iddet."','".$fecha."','".$idSec."','P')";
      }else{
        $stringInser=",('".$iddet."','".$fecha."','".$idSec."','P')";
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

  public function retornaDetalleDescargarSec($idsec){
    $stmt = $this->objPDO->prepare("SELECT (id_detalle) as detalle FROM sisesterilizacion.carga_secadora WHERE id_secadora='".$idsec."' and estado='P'");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
  }

  public function actulizaDescargaSec($iddetalle){
    $conexion=new cado();
		$conexion->conectar();
    $fecha=$this->fecha();
		$sql="UPDATE sisesterilizacion.carga_secadora SET fecha_descarga='".$fecha."', estado= 'T' WHERE id_detalle='".$iddetalle."';";
		$rs=pg_query($sql) or die(false);
		if($rs=true){
      return "true";
    }else{
      return "false";
    }
  }

}


?>
