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
    $stmt = $this->objPDO->prepare("SELECT id_ultrazonica, nombre_ultrazonica FROM sisesterilizacion.ultrazonica WHERE estado='D'");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
  }

  public function retornaUltrazonicaOcupadas(){
    $stmt = $this->objPDO->prepare("SELECT id_ultrazonica, nombre_ultrazonica FROM sisesterilizacion.ultrazonica WHERE estado='O'");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
  }
}

?>
