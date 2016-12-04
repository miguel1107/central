<?php
require_once "cado.php";
/**
 *
 */
class detalleIngMaterial {

  private $objPDO;

  function __construct(){
    $this->objPDO = new cado();
  }

  public function regIngresoDetalleMat($materiales,$idIngreso){
    $mat=$materiales;
    $id=$idIngreso;
    $conexion=new cado();
		$conexion->conectar();
    $l=count($mat);
    $sql="INSERT INTO sisesterilizacion.detalle_ingmaterial(id_ingreso_material, tipo_ingreso, id_matset, cantidad_material, codigo_est, ubicacion, procesozr, procesoza) VALUES ";
    for ($i=0; $i <$l ; $i++) {
      $tipo=$mat[$i][0];
      $idMatSet=$mat[$i][1];
      $numPiezas=$mat[$i][3];
      $tipoEste=$mat[$i][4];
      if ($i==0) {
        $stringInser="('".$id."','".$tipo."','".$idMatSet."','".$numPiezas."','".$tipoEste."','REC','P','P')";
      }else{
        $stringInser=",('".$id."','".$tipo."','".$idMatSet."','".$numPiezas."','".$tipoEste."','REC','P','P')";
      }
      $sql=$sql.$stringInser;
    }
    $rs=pg_query($sql) or die(alse);
		return $rs;
  }
}



?>
