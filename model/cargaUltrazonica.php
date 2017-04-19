<?php
require_once "cado.php";
require_once __DIR__.'/../model/detalleIngMaterial.php';
require_once __DIR__.'/../model/ingresoMaterial.php';

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
    $ingmat=new ingresoMaterial();
    $det=new detalleIngMaterial();
    $conexion=new cado();
		$conexion->conectar();
    $fecha=$this->fecha();
    $l=count($mat);
		$sql="INSERT INTO sisesterilizacion.carga_ultrazonica(id_detalle, fecha_carga, id_ultrazonica,estado) VALUES";
    for ($i=0; $i <$l ; $i++) {
      $iddet=$mat[$i][0];
      $iding=$mat[$i][1];
      $det->actualizaUltrazonica($iddet,'P');
      $ingmat->entraSaleUltra($iding,'P');
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

  public function retornaDetalleDescargar($idultra){
    $stmt = $this->objPDO->prepare("SELECT (id_detalle) as detalle FROM sisesterilizacion.carga_ultrazonica WHERE id_ultrazonica='".$idultra."' and estado='P'");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
  }

  public function actulizaCarga($iddetalle){
    $conexion=new cado();
		$conexion->conectar();
    $fecha=$this->fecha();
		$sql="UPDATE sisesterilizacion.carga_ultrazonica SET fecha_descarga='".$fecha."', estado= 'T' WHERE id_detalle='".$iddetalle."';";
		$rs=pg_query($sql) or die(false);
		if($rs==true){
      return "true";
    }else{
      return "false";
    }
  }
}


?>
