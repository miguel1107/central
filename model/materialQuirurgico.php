<?php
	require_once "cado.php";

	/**
	*
	*/
	class materialQuirurgico {
		private $objPDO;


		function __construct(){
			$this->objPDO = new cado();
		}

		public function listadoMaterial(){
			$stmt = $this->objPDO->prepare("SELECT * FROM sisesterilizacion.material_quirurgico");
			$stmt->execute();
			$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
			return $ls;
		}

		public function listasautocomplete($material){
			$stmt = $this->objPDO->prepare("SELECT id_mat,codigo_mat,nombre_material||'-'||codigo_mat as material FROM sisesterilizacion.material_quirurgico WHERE nombre_material LIKE :material OR codigo_mat LIKE :material LIMIT 5");
			$stmt->execute(array('material'=>$material));
			$mat = $stmt->fetchAll(PDO::FETCH_OBJ);
			return $mat;
		}

	}
?>
