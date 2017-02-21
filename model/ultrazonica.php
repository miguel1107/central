<?php
require_once "cado.php";
/**
 *
 */
class ultrazonica {
  private $objPDO;

  function __construct(){
    $this->objPDO = new cado();
  }

  public function retornaUltrazonica(){
    $stmt = $this->objPDO->prepare("SELECT id_ultrazonica, nombre_ultrazonica FROM sisesterilizacion.ultrazonica WHERE estado='D' order by id_ultrazonica asc");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
  }

  public function retornaUltrazonicaOcupadas(){
    $stmt = $this->objPDO->prepare("SELECT id_ultrazonica, nombre_ultrazonica FROM sisesterilizacion.ultrazonica WHERE estado='O' order by id_ultrazonica");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
  }

  public function actualizaEstado($idUltra,$estado){
    $conexion=new cado();
		$conexion->conectar();
    $sql="UPDATE sisesterilizacion.ultrazonica SET estado='".$estado."'  WHERE id_ultrazonica='".$idUltra."';";
    $rs=pg_query($sql) or die(false);
		if($rs==true){
      return "true";
    }else{
      return "false";
    }
  }

  public function verCarga($ultrazonica){
    $stmt = $this->objPDO->prepare("SELECT * FROM sisesterilizacion.carga_ultrazonica c INNER JOIN sisesterilizacion.detalle_ingmaterial ing on ing.id_detalle=c.id_detalle WHERE id_ultrazonica='".$ultrazonica."' and estado='P'");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
  }
}

?>
