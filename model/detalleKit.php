<?php
require_once "cado.php";
/**
 *
 */
class detalleKit {

  private $objPDO;

  function __construct(){
    $this->objPDO = new cado();
  }

  public function regIngresoDetalleKit($kit,$idIngreso){
    $mat=$kit;
    $id=$idIngreso;
    $conexion=new cado();
		$conexion->conectar();
    $l=count($mat);
    $sql="INSERT INTO sisesterilizacion.detalle_kit(id_kit, id_material, piezas_material, nombre_mat) VALUES ";
    for ($i=0; $i <$l ; $i++) {
      $idMat=$mat[$i][0];
      $nombre=$mat[$i][2];
      $numPiezas=$mat[$i][1];
      if ($i==0) {
        $stringInser="('".$id."','".$idMat."','".$numPiezas."','".$nombre."')";
      }else{
        $stringInser=",('".$id."','".$idMat."','".$numPiezas."','".$nombre."')";
      }
      $sql=$sql.$stringInser;
    }
    $rs=pg_query($sql) or die(false);
		echo $rs;
  }

  public function listadoDetallekit($id){
    $stmt = $this->objPDO->prepare("SELECT * FROM sisesterilizacion.detalle_kit where id_kit='$id' order by nombre_mat asc");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
  }
}
?>
