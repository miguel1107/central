<?php
	require_once "cado.php";

	/**
	*
	*/
class servicio {

	private $objPDO;

	function __construct(){
		$this->objPDO = new cado();
	}

	public function listadoServicio(){
		$stmt = $this->objPDO->prepare("SELECT * FROM sisesterilizacion.servicio order by id_servicio asc");
		$stmt->execute();
		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
		return $ls;
	}

	public function retornaNombre($id){
		$stmt = $this->objPDO->prepare("SELECT nombre_servicio FROM sisesterilizacion.servicio WHERE id_servicio='$id' ");
		$stmt->execute();
		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
		return $ls;
	}

	public function listasautocomplete($ser){
		$stmt = $this->objPDO->prepare("SELECT id_servicio,nombre_servicio as nombre FROM sisesterilizacion.servicio WHERE nombre_servicio like :ser limit 5");
		$stmt->execute(array('ser'=>$ser));
		$sets = $stmt->fetchAll(PDO::FETCH_OBJ);
		return $sets;
	}

	//mantenimientos
	public function insertarServicio($nomb){
		$conexion=new cado();
		$conexion->conectar();
		$sql="INSERT INTO sisesterilizacion.servicio(nombre_servicio) VALUES ('$nomb');";
		$rs=pg_query($sql) or die(false);
		return $rs;
	}

	public function actualizarServicio($nom,$id){
		$conexion=new cado();
		$conexion->conectar();
		$sql="UPDATE sisesterilizacion.servicio SET nombre_servicio='$nom' WHERE id_servicio='$id'; ";
		$rs=pg_query($sql) or die (false);
		return $rs;
	}

	public function eliminarServicio($id){
		$conexion=new cado();
		$conexion->conectar();
		$sql="DELETE FROM sisesterilizacion.servicio WHERE id_servicio='$id'";
		$rs=pg_query($sql) or die (false);
		return $rs;
	}

}

?>
