<?php
	require_once "cado.php";

	class empleado{

		private $objPdo;

		function __construct(){
			$this->objPdo = new cado();
		}

		public function listaempleados($empleados){
			$stmt = $this->objPdo->prepare("SELECT emp_id,emp_dni, emp_appaterno||' '|| emp_apmaterno||' '|| emp_nombres as nombres FROM empleados WHERE emp_appaterno like :empleados limit 3");
			$stmt->execute(array('empleados'=>$empleados));
			$empleado = $stmt->fetchAll(PDO::FETCH_OBJ);
			return $empleado;
		}
	}
	 ?>
