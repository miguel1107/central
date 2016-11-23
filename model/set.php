<?php
require_once "cado.php";
/**
 *
 */
class set{

	private $objPDO;

	public function __construct()	{
		$this->objPdo = new cado();
	}

	public function listadoset(){
		$stmt=$this->objPdo->prepare("SELECT * FROM sisesterilizacion.set order by nombre_set asc");
		$stmt->execute();
		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
		return $ls;
	}

	public function listaetauto($setn){
		$stmt = $this->objPdo->prepare("SELECT * FROM sisesterilizacion.set WHERE nombre_set LIKE :setn LIMIT 5 ");
		$stmt->execute(array('setn'=>$setn));
		$sets = $stmt->fetchAll(PDO::FETCH_OBJ);
		return $sets;
	}
}

?>
