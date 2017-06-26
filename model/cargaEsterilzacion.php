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

  //ZA-carga esterilizador
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

  //ZV-descargar esterilizador
  public function retornaDetalleDescargar($idEste){
    $stmt = $this->objPDO->prepare("SELECT im.tipo_propietario,im.id_ingreso,dim.id_detalle,ce.paquetes,dim.descripcion,dim.cantidad_material,dim.tipo_ingreso,ce.id_carga,ce.id_esterilizador
      FROM sisesterilizacion.carga_esterilizador ce
      INNER JOIN sisesterilizacion.detalle_ingmaterial dim ON dim.id_detalle=ce.id_detalle
      INNER JOIN sisesterilizacion.ingreso_material im ON im.id_ingreso=dim.id_ingreso_material
      WHERE ce.estado='P' and ce.id_esterilizador='".$idEste."';");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
  }
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
