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
