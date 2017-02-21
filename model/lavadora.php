<?php
require_once "cado.php";

/**
 *
 */
class lavadora{
  private $objPDO;

  function __construct(){
    $this->objPDO = new cado();
  }

  public function retornaLavadoras(){
    $stmt = $this->objPDO->prepare("SELECT id_lavadora, nombre_lavadora FROM sisesterilizacion.lavadora WHERE estado='D' order by id_lavadora ASC");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
  }

  public function retornaLavadorasOcupadas(){
    $stmt = $this->objPDO->prepare("SELECT id_lavadora, nombre_lavadora FROM sisesterilizacion.lavadora WHERE estado='O'");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
  }

  public function actualizaEstado($idLav,$estado){
    $conexion=new cado();
		$conexion->conectar();
    $sql="UPDATE sisesterilizacion.lavadora SET estado='".$estado."'  WHERE id_lavadora='".$idLav."';";
    $rs=pg_query($sql) or die(false);
		if($rs==true){
      return "true";
    }else{
      return "false";
    }
  }

  public function verCarga($lav){
    $stmt = $this->objPDO->prepare("SELECT * FROM sisesterilizacion.carga_lavadora c INNER JOIN sisesterilizacion.detalle_ingmaterial ing on ing.id_detalle=c.id_detalle WHERE id_lavadora='".$lav."' and estado='P'");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
  }


}

?>
