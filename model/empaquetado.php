<?php
require_once "cado.php";

/**
 *
 */
class empaquetado{
  private $objPDO;

  function __construct(){
    $this->objPDO = new cado();
  }

  public function registrar($cantdad,$env,$tipo,$iddt){
    $conexion=new cado();
		$conexion->conectar();
    $fecha=$this->fecha();
    $sql="INSERT INTO sisesterilizacion.empaque(fecha_empaque, cantidad, id_tipo_envoltura, id_set, id_kit, id_mat)";
    if ($tipo=='Mat') {
      $sqlval="VALUES ('".$fecha."', '".$cantdad."','".$env."', '0', '0', '".$iddt."');";
    }else if ($tipo=="Set") {
      $sqlval="VALUES ('".$fecha."', '".$cantdad."','".$env."', '".$iddt."', '0', '0');";
    }else if ($tipo=="Kit") {
      $sqlval="VALUES ('".$fecha."', '".$cantdad."','".$env."', '0', '".$iddt."', '0');";
    }
    $insert=$sql.$sqlval;
    $rs=pg_query($insert) or die(false);
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

}

?>
