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
    $sql="INSERT INTO sisesterilizacion.detalle_ingmaterial(id_ingreso_material, tipo_ingreso, id_mat, cantidad_material, codigo_est, ubicacion, procesozr, procesoza,id_set,id_kit,descripcion,ultrazonica,lv_mecanico,lv_manual,sec_mecanico,sec_manual,cantidad_tipo) VALUES ";
    for ($i=0; $i <$l ; $i++) {
      $tipo=$mat[$i][0];
      $idMatSet=$mat[$i][1];
      $descripcion=$mat[$i][2];
      $numPiezas=$mat[$i][3];
      $tipoEste=$mat[$i][4];
      $cantipo=$mat[$i][5];
      if ($i==0) {
        if($tipo=='Set'){
          $stringInser="('".$id."','".$tipo."','0','".$numPiezas."','".$tipoEste."','REC','P','P','".$idMatSet."','0','".$descripcion."','FALSE','FALSE','FALSE','FALSE','FALSE','".$cantipo."')";
        }elseif($tipo=='Mat'){
          $stringInser="('".$id."','".$tipo."','".$idMatSet."','".$numPiezas."','".$tipoEste."','REC','P','P','0','0','".$descripcion."','FALSE','FALSE','FALSE','FALSE','FALSE','".$cantipo."')";
        }else{
          $stringInser="('".$id."','".$tipo."','0','".$numPiezas."','".$tipoEste."','REC','P','P','0','".$idMatSet."','".$descripcion."','FALSE','FALSE','FALSE','FALSE','FALSE','".$cantipo."')";
        }
      }else{
        if($tipo=='Set'){
          $stringInser=",('".$id."','".$tipo."','0','".$numPiezas."','".$tipoEste."','REC','P','P','".$idMatSet."','0','".$descripcion."','FALSE','FALSE','FALSE','FALSE','FALSE','".$cantipo."')";
        }elseif($tipo=='Mat'){
          $stringInser=",('".$id."','".$tipo."','".$idMatSet."','".$numPiezas."','".$tipoEste."','REC','P','P','0','0','".$descripcion."','FALSE','FALSE','FALSE','FALSE','FALSE','".$cantipo."')";
        }else{
          $stringInser=",('".$id."','".$tipo."','0','".$numPiezas."','".$tipoEste."','REC','P','P','0','".$idMatSet."','".$descripcion."','FALSE','FALSE','FALSE','FALSE','FALSE','".$cantipo."')";
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

//ZR-ultrazonica
  public function retornaDetalle($id){
    $stmt = $this->objPDO->prepare("SELECT tipo_ingreso,cantidad_material, descripcion,id_detalle FROM sisesterilizacion.detalle_ingmaterial where id_ingreso_material='".$id."' and ultrazonica='FALSE';");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
  }

  public function actualizaUltrazonica($iddet,$estado){
    $conexion=new cado();
		$conexion->conectar();
    $sql="UPDATE sisesterilizacion.detalle_ingmaterial SET procesozr='".$estado."',ubicacion='ULT',ultrazonica='TRUE'  WHERE id_detalle='".$iddet."';";
    $rs=pg_query($sql);
  }

  public function actualizaIngreso($idingmat){
    $stmt = $this->objPDO->prepare("SELECT ultrazonica,procesozr FROM sisesterilizacion.detalle_ingmaterial WHERE id_ingreso_material='".$idingmat."'");
    $stmt->execute();
    $aux=0;//todo los detalles estan en ultrazonica y T
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    foreach ($ls as $l) {
      $es=$l->ultrazonica;
      $es2=$l->procesozr;
      if($es=='f'){
        $aux=1;//al menos uno esta en recepcion
      }else {
        if($es2=='P'){
          $aux=1;
        }
      }
    }
    if ($aux==0) {
      return "true";
    }else {
      return "false";
    }
  }

  public function retornaCantidadDetalleValor($idIng){
    $conexion=new cado();
		$conexion->conectar();
    $sql=("SELECT count(*) FROM sisesterilizacion.detalle_ingmaterial where id_ingreso_material='".$idIng."' and ultrazonica=TRUE and procesozr='T' ;");
    $rs=pg_query($sql);
    if(pg_num_rows($rs)==1){
      if($row=pg_fetch_array($rs)){
        $can=$row[0];
      }
    }
    return $can;
  }

  public function retornaCantidadDetalle($idIng){
    $conexion=new cado();
		$conexion->conectar();
    $sql=("SELECT count(*) FROM sisesterilizacion.detalle_ingmaterial where id_ingreso_material='".$idIng."' ;");
    $rs=pg_query($sql);
    if(pg_num_rows($rs)==1){
      if($row=pg_fetch_array($rs)){
        $can=$row[0];
      }
    }
    return $can;
  }

//ZR-lavadoras
  public function retornaDetalleLav($id){
    $stmt = $this->objPDO->prepare("SELECT tipo_ingreso,cantidad_material, descripcion,id_detalle FROM sisesterilizacion.detalle_ingmaterial where ultrazonica='TRUE' and lv_mecanico='FALSE' and lv_manual='FALSE' and id_ingreso_material='".$id."' ;");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
  }

  public function actualizaLavadora($iddet,$tipo,$estado){
    $conexion=new cado();
    $conexion->conectar();
    if($tipo=="LA"){
        $sql="UPDATE sisesterilizacion.detalle_ingmaterial SET ubicacion='LAM',lv_mecanico='TRUE',procesozr='".$estado."'  WHERE id_detalle='".$iddet."';";
    }else{
      $sql="UPDATE sisesterilizacion.detalle_ingmaterial SET ubicacion='SEC',lv_mecanico='TRUE',sec_mecanico='TRUE',procesozr='".$estado."'  WHERE id_detalle='".$iddet."';";
    }
    $rs=pg_query($sql) or die(false);
    if($rs==true){
      return "true";
    }else{
      return "false";
    }
  }

  public function actualizaDescarga($iddet){
    $conexion=new cado();
		$conexion->conectar();
    $sql="UPDATE sisesterilizacion.detalle_ingmaterial SET procesozr='T'  WHERE id_detalle='".$iddet."';";
    $rs=pg_query($sql);
  }

  public function actualizaIngresoLav($idingmat){
    $stmt = $this->objPDO->prepare("SELECT lv_mecanico,lv_manual FROM sisesterilizacion.detalle_ingmaterial WHERE id_ingreso_material='".$idingmat."'");
    $stmt->execute();
    $aux=0;//todo los detalles estan en ultrazonica
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    foreach ($ls as $l) {
      $es=$l->lv_mecanico;
      $es2=$l->lv_manual;
      if($es=='f'){
        if($es2=='f'){
          $aux=1;//al menos uno no entra al lav mec
        }
      }
    }
    if ($aux==0) {
      return "true";
    }else {
      return "false";
    }
  }

  public function retornaCantidadDetalleVarlorLav($idIng){
    $conexion=new cado();
		$conexion->conectar();
    $sql=("SELECT count(*) FROM sisesterilizacion.detalle_ingmaterial where (id_ingreso_material='".$idIng."' and lv_mecanico=TRUE and procesozr='T') or (id_ingreso_material='".$idIng."' and lv_manual=TRUE and procesozr='T');");
    $rs=pg_query($sql);
    if(pg_num_rows($rs)==1){
      if($row=pg_fetch_array($rs)){
        $can=$row[0];
      }
    }
    return $can;
  }

  public function retornaCantidadDetallaLav($idIng){
    $conexion=new cado();
		$conexion->conectar();
    $sql=("SELECT count(*) FROM sisesterilizacion.detalle_ingmaterial where id_ingreso_material='".$idIng."';");
    $rs=pg_query($sql);
    if(pg_num_rows($rs)==1){
      if($row=pg_fetch_array($rs)){
        $can=$row[0];
      }
    }
    return $can;
  }

  public function actualizaLavadoraManual($iddet,$estado){
    $conexion=new cado();
    $conexion->conectar();
    $sql="UPDATE sisesterilizacion.detalle_ingmaterial SET ubicacion='LAM',lv_mecanico='FALSE',lv_manual='TRUE',procesozr='T'  WHERE id_detalle='".$iddet."';";
    $rs=pg_query($sql) or die(false);
    if($rs==true){
      return "true";
    }else{
      return "false";
    }
  }

//ZR-secadora
  public function retornaDetalleSec($id){
    $stmt = $this->objPDO->prepare("SELECT tipo_ingreso,cantidad_material, descripcion,id_detalle FROM sisesterilizacion.detalle_ingmaterial where sec_mecanico='FALSE' and sec_manual='FALSE' and id_ingreso_material='".$id."' ;");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
  }

  public function actualizaSecadora($iddet,$estado){
    $conexion=new cado();
		$conexion->conectar();
    $sql="UPDATE sisesterilizacion.detalle_ingmaterial SET procesozr='".$estado."',ubicacion='SEC',sec_mecanico='TRUE' WHERE id_detalle='".$iddet."';";
    $rs=pg_query($sql);
  }

  public function actualizaDescargaSec($iddet){
    $conexion=new cado();
		$conexion->conectar();
    $sql="UPDATE sisesterilizacion.detalle_ingmaterial SET procesozr='T'  WHERE id_detalle='".$iddet."';";
    $rs=pg_query($sql);
  }

  public function actualizaIngresoSec($idingmat){
    $stmt = $this->objPDO->prepare("SELECT sec_mecanico,sec_manual FROM sisesterilizacion.detalle_ingmaterial WHERE id_ingreso_material='".$idingmat."'");
    $stmt->execute();
    $aux=0;//todo los detalles estan en ultrazonica
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    foreach ($ls as $l) {
      $es=$l->lv_mecanico;
      $es2=$l->lv_manual;
      if($es=='f'){
        if($es2=='f'){
          $aux=1;//al menos uno no entra al lav mec
        }
      }
    }
    if ($aux==0) {
      return "true";
    }else {
      return "false";
    }
  }

  public function retornaCantidadDetalleVarlorSec($idIng){
    $conexion=new cado();
		$conexion->conectar();
    $sql=("SELECT count(*) FROM sisesterilizacion.detalle_ingmaterial where (id_ingreso_material='".$idIng."' and sec_mecanico=TRUE and procesozr='T') or (id_ingreso_material='".$idIng."' and sec_manual=TRUE and procesozr='T');");
    $rs=pg_query($sql);
    if(pg_num_rows($rs)==1){
      if($row=pg_fetch_array($rs)){
        $can=$row[0];
      }
    }
    return $can;
  }

  public function retornaCantidadDetallaSec($idIng){
    $conexion=new cado();
		$conexion->conectar();
    $sql=("SELECT count(*) FROM sisesterilizacion.detalle_ingmaterial where id_ingreso_material='".$idIng."';");
    $rs=pg_query($sql);
    if(pg_num_rows($rs)==1){
      if($row=pg_fetch_array($rs)){
        $can=$row[0];
      }
    }
    return $can;
  }

  public function actualizaSecadoManual($iddet,$estado){
    $conexion=new cado();
    $conexion->conectar();
    $sql="UPDATE sisesterilizacion.detalle_ingmaterial SET ubicacion='SEC',sec_mecanico='FALSE',sec_manual='TRUE',procesozr='".$estado."'  WHERE id_detalle='".$iddet."';";
    $rs=pg_query($sql) or die(false);
    if($rs==true){
      return "true";
    }else{
      return "false";
    }
  }

  //ZA-empaquetado
  public function retornaDetalleEmp($id){
    $stmt = $this->objPDO->prepare("SELECT tipo_ingreso,cantidad_material, descripcion,id_detalle,codigo_est FROM sisesterilizacion.detalle_ingmaterial where ubicacion='SEC' and procesozr='T' and id_ingreso_material='".$id."' ;");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
  }
}
?>
