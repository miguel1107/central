<?php
	require_once "cado.php";

/**
 *
 */
class tipoenvoltura{

  private $objPDO;

	function __construct(){
    $this->objPDO = new cado();
  }

  public function listado(){
		$stmt = $this->objPDO->prepare("SELECT * FROM sisesterilizacion.tipo_envoltura order by id_tipo_envoltura asc");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
	}

}
?>
