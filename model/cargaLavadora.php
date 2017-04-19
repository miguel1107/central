<?php
require_once "cado.php";
require_once __DIR__.'/../model/detalleIngMaterial.php';
require_once __DIR__.'/../model/ingresoMaterial.php';

/**
 *
 */
class cargaLavadora{

  private $objPDO;

  function __construct(){
    $this->objPDO = new cado();
  }

  public function registroCargaLav($materiales,$idLav,$tipo){
    $mat=$materiales;
    $det=new detalleIngMaterial();
    $ingmat=new ingresoMaterial();
    $conexion=new cado();
		$conexion->conectar();
    $fecha=$this->fecha();
    $l=count($mat);
		$sql="INSERT INTO sisesterilizacion.carga_lavadora( id_detalle, fecha_carga,id_lavadora, proceso, estado) VALUES ";
    for ($i=0; $i <$l ; $i++) {
      $iddet=$mat[$i][0];
      $iding=$mat[$i][1];
      $det->actualizaLavadora($iddet,$tipo,'P');
      $ingmat->entraSaleLav($iding,'P',$tipo);
      if($i==0){
        $stringInser="('".$iddet."','".$fecha."','".$idLav."','".$tipo."','P')";
      }else{
        $stringInser=",('".$iddet."','".$fecha."','".$idLav."','".$tipo."','P')";
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

  public function retornaDetalleDescargar($idlav){
    $stmt = $this->objPDO->prepare("SELECT (id_detalle) as detalle FROM sisesterilizacion.carga_lavadora WHERE id_lavadora='".$idlav."' and estado='P'");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
  }

  public function actulizaDescargaLav($iddetalle){
    $conexion=new cado();
		$conexion->conectar();
    $fecha=$this->fecha();
		$sql="UPDATE sisesterilizacion.carga_lavadora SET fecha_descarga='".$fecha."', estado= 'T' WHERE id_detalle='".$iddetalle."';";
		$rs=pg_query($sql) or die(false);
		if($rs=true){
      return "true";
    }else{
      return "false";
    }
  }

}


?>
