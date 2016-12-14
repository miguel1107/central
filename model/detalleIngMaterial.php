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
    $sql="INSERT INTO sisesterilizacion.detalle_ingmaterial(id_ingreso_material, tipo_ingreso, id_mat, cantidad_material, codigo_est, ubicacion, procesozr, procesoza,id_set,descripcion,ultrazonica,lv_mecanico,lv_manual,sec_mecanico,sec_manual) VALUES ";
    for ($i=0; $i <$l ; $i++) {
      $tipo=$mat[$i][0];
      $idMatSet=$mat[$i][1];
      $descripcion=$mat[$i][2];
      $numPiezas=$mat[$i][3];
      $tipoEste=$mat[$i][4];
      if ($i==0) {
        if($tipo=='Set'){
          $stringInser="('".$id."','".$tipo."','0','".$numPiezas."','".$tipoEste."','REC','P','P','".$idMatSet."','".$descripcion."','FALSE','FALSE','FALSE','FALSE','FALSE')";
        }else{
          $stringInser="('".$id."','".$tipo."','".$idMatSet."','".$numPiezas."','".$tipoEste."','REC','P','P','0','".$descripcion."','FALSE','FALSE','FALSE','FALSE','FALSE')";
        }

      }else{
        if($tipo=='Set'){
          $stringInser=",('".$id."','".$tipo."','0','".$numPiezas."','".$tipoEste."','REC','P','P','".$idMatSet."','".$descripcion."','FALSE','FALSE','FALSE','FALSE','FALSE')";
        }else{
          $stringInser=",('".$id."','".$tipo."','".$idMatSet."','".$numPiezas."','".$tipoEste."','REC','P','P','0','".$descripcion."','FALSE','FALSE','FALSE','FALSE','FALSE')";
        }
      }
      $sql=$sql.$stringInser;
    }
    $rs=pg_query($sql) or die(alse);
		return $rs;
  }

  public function retornaDetalle($id){
    $stmt = $this->objPDO->prepare("SELECT tipo_ingreso,cantidad_material, descripcion FROM sisesterilizacion.detalle_ingmaterial where id_ingreso_material='".$id."' and ultrazonica='FALSE';");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
  }


}
?>
