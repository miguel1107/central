<?php
require_once "cado.php";

/**
 *
 */
class secadora{
  private $objPDO;

  function __construct(){
    $this->objPDO = new cado();
  }

  public function retornaSecadoras(){
    $stmt = $this->objPDO->prepare("SELECT id_secadora, nombre_secadora FROM sisesterilizacion.secadora WHERE estado='D' order by id_secadora ASC");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
  }

  public function retornaSecadorasOcupadas(){
    $stmt = $this->objPDO->prepare("SELECT id_secadora, nombre_secadora FROM sisesterilizacion.secadora WHERE estado='O'");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
  }

  public function actualizaEstadoSec($idSec,$estado){
    $conexion=new cado();
		$conexion->conectar();
    $sql="UPDATE sisesterilizacion.secadora SET estado='".$estado."'  WHERE id_secadora='".$idSec."';";
    $rs=pg_query($sql) or die(false);
		if($rs==true){
      return "true";
    }else{
      return "false";
    }
  }

  public function verCarga($sec){
    $stmt = $this->objPDO->prepare("SELECT * FROM sisesterilizacion.carga_secadora c INNER JOIN sisesterilizacion.detalle_ingmaterial ing on ing.id_detalle=c.id_detalle WHERE id_secadora='".$sec."' and estado='P'");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
  }

}

?>
