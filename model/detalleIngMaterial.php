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
    $sql="INSERT INTO sisesterilizacion.detalle_ingmaterial(id_ingreso_material, tipo_ingreso, id_mat, cantidad_material, codigo_est, ubicacion, procesozr, procesoza,id_set,id_kit,descripcion,ultrazonica,lv_mecanico,lv_manual,sec_mecanico,sec_manual) VALUES ";
    for ($i=0; $i <$l ; $i++) {
      $tipo=$mat[$i][0];
      $idMatSet=$mat[$i][1];
      $descripcion=$mat[$i][2];
      $numPiezas=$mat[$i][3];
      $tipoEste=$mat[$i][4];
      if ($i==0) {
        if($tipo=='Set'){
          $stringInser="('".$id."','".$tipo."','0','".$numPiezas."','".$tipoEste."','REC','P','P','".$idMatSet."','0','".$descripcion."','FALSE','FALSE','FALSE','FALSE','FALSE')";
        }elseif($tipo=='Mat'){
          $stringInser="('".$id."','".$tipo."','".$idMatSet."','".$numPiezas."','".$tipoEste."','REC','P','P','0','0','".$descripcion."','FALSE','FALSE','FALSE','FALSE','FALSE')";
        }else{
          $stringInser="('".$id."','".$tipo."','0','".$numPiezas."','".$tipoEste."','REC','P','P','0','".$idMatSet."','".$descripcion."','FALSE','FALSE','FALSE','FALSE','FALSE')";
        }
      }else{
        if($tipo=='Set'){
          $stringInser=",('".$id."','".$tipo."','0','".$numPiezas."','".$tipoEste."','REC','P','P','".$idMatSet."','0','".$descripcion."','FALSE','FALSE','FALSE','FALSE','FALSE')";
        }elseif($tipo=='Mat'){
          $stringInser=",('".$id."','".$tipo."','".$idMatSet."','".$numPiezas."','".$tipoEste."','REC','P','P','0','0','".$descripcion."','FALSE','FALSE','FALSE','FALSE','FALSE')";
        }else{
          $stringInser=",('".$id."','".$tipo."','0','".$numPiezas."','".$tipoEste."','REC','P','P','0','".$idMatSet."','".$descripcion."','FALSE','FALSE','FALSE','FALSE','FALSE')";
        }
      }
      $sql=$sql.$stringInser;
    }
    $rs=pg_query($sql) or die(false);
    if($rs=true){
      return "true";
    }else{
      return "false";
    }
  }

  public function retornaDetalle($id){
    $stmt = $this->objPDO->prepare("SELECT tipo_ingreso,cantidad_material, descripcion,id_detalle FROM sisesterilizacion.detalle_ingmaterial where id_ingreso_material='".$id."' and ultrazonica='FALSE';");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
  }

  public function actualizaUltrazonica($iddet){
    $conexion=new cado();
		$conexion->conectar();
    $sql="UPDATE sisesterilizacion.detalle_ingmaterial SET ubicacion='ULT',ultrazonica='TRUE'  WHERE id_detalle='".$iddet."';";
    $rs=pg_query($sql) or die(false);
		if($rs==true){
      return "true";
    }else{
      return "false";
    }
  }

  public function actualizaIngreso($idingmat){
    $stmt = $this->objPDO->prepare("SELECT ultrazonica FROM sisesterilizacion.detalle_ingmaterial WHERE id_ingreso_material='".$idingmat."'");
    $stmt->execute();
    $aux=0;//todo los detalles estan en ultrazonica
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    foreach ($ls as $l) {
      $es=$l->ultrazonica;
      return $es;
      if($es=='f'){
        $aux=1;//al menos uno esta en recepcion
      }
    }
    if ($aux==0) {
      return "true";
    }else {
      return "false";
    }
  }

  public function retornaNombre($idingmat){
    $conexion=new cado();
    $conexion->conectar();
    $sql="SELECT ultrazonica FROM sisesterilizacion.detalle_ingmaterial WHERE id_ingreso_material='".$idingmat."'";
    $rs=pg_query($sql);
    if(pg_num_rows($rs)==1){
      if($row=pg_fetch_array($rs)){
        $es=$row['ultrazonica'];
      }
    }
    return $es;
  }

}
?>
