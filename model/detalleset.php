<?php
	require_once "cado.php";

/**
 *
 */
class detalleSet{

  private $objPDO;

	function __construct(){
    $this->objPDO = new cado();
  }

  public function listadoDetalleset($id){
		$stmt = $this->objPDO->prepare("SELECT id_detalle, id_set, id_material, piezas_material, nombre_mat FROM sisesterilizacion.detalle_set where id_set='$id' order by nombre_mat asc");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
	}

}
?>
