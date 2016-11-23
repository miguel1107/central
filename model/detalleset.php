<?php
	require_once "cado.php";

/**
 *
 */
class detalleSet extends clsAccesoDatos	{

  private $objPDO;

	public function __construct(){
		parent::__construct();
	}

  public function listadoDetalleset($id){
		$sql="SELECT id_detalle, id_set, id_material, piezas_material, nombre_mat FROM sisesterilizacion.detalle_set where id_set='$id' order by nombre_mat asc";
		return clsAccesoDatos::obtenerDataSQL($sql);
		}

}
?>
