<?php
require_once "cado.php";

/**
 *
 */
class tipoesterilizacion{

  private $objPDO;

  function __construct(){
    $this->objPDO=new cado();
  }

  public function listartipos(){
		$stmt=$this->objPDO->prepare("SELECT nombre,codigo FROM sisesterilizacion.tipoesterilizacion WHERE estado='A'");
		$stmt->execute();
		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
		return $ls;
	}

}


 ?>
