<?php
require_once "cado.php";

/**
 *
 */
class esterilizador{

  private $objPDO;

  function __construct(){
    $this->objPDO = new cado();
  }

  public function cargaCombo($tipo){
    $stmt = $this->objPDO->prepare("SELECT id_esterilizador,descripcion FROM sisesterilizacion.esterilizador where sisesterilizacion.esterilizador.tipo_esterilizacion='".$tipo."'  and estado='D' order by id_esterilizador");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
  }

  public function actualizaEsterilizador($ideste,$estado){
    $conexion=new cado();
    $conexion->conectar();
    $sql="UPDATE sisesterilizacion.esterilizador SET estado='".$estado."'  WHERE id_esterilizador='".$ideste."';";
    $rs=pg_query($sql) or die(false);
    if($rs==true){
      return "true";
    }else{
      return "false";
    }
  }

}


?>
