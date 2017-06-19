<?php
session_start();
require_once "cado.php";
require_once __DIR__.'/../model/esterilizador.php';
require_once __DIR__.'/../model/detalleIngMaterial.php';
/**
 *
 */
class cargaEsterilizacion{

  private $objPDO;

  function __construct(){
    $this->objPDO = new cado();
  }

  public function registroCarga($materiales,$idEste){
    $mat=$materiales;
    $idusu=$_SESSION["idusuario"];
    $esterilizador=new esterilizador();
    $det=new detalleIngMaterial();
    $conexion=new cado();
		$conexion->conectar();
    $fecha=$this->fecha();
    $l=count($mat);
		$sql="INSERT INTO sisesterilizacion.carga_esterilizador(id_detalle, fecha_carga,id_usuario_carga,estado,id_esterilizador,paquetes) VALUES ";
    for ($i=0; $i <$l ; $i++) {
      $iddet=$mat[$i][0];
      $cant=$mat[$i][1];
      $faltacargar=$mat[$i][2];
      $det->actualizaCargaEste($iddet,$faltacargar);
      //$det->actualizaEstirilizador($iddet,$tipo,'P');
      //$ingmat->entraSaleLav($iding,'P',$tipo);
      if($i==0){
        $stringInser="('".$iddet."','".$fecha."','".$idusu."','P','".$idEste."','".$cant."')";
      }else{
        $stringInser=",('".$iddet."','".$fecha."','".$idusu."','P','".$idEste."','".$cant."')";
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

  // public function retornaDetalleDescargar($idlav){
  //   $stmt = $this->objPDO->prepare("SELECT (id_detalle) as detalle FROM sisesterilizacion.carga_lavadora WHERE id_lavadora='".$idlav."' and estado='P'");
  //   $stmt->execute();
  //   $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  //   return $ls;
  // }
  //
  // public function actulizaDescargaLav($iddetalle){
  //   $conexion=new cado();
	// 	$conexion->conectar();
  //   $fecha=$this->fecha();
	// 	$sql="UPDATE sisesterilizacion.carga_lavadora SET fecha_descarga='".$fecha."', estado= 'T' WHERE id_detalle='".$iddetalle."';";
	// 	$rs=pg_query($sql) or die(false);
	// 	if($rs=true){
  //     return "true";
  //   }else{
  //     return "false";
  //   }
  // }

}


?>
