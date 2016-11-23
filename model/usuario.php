<?php
	require_once "cado.php";
	//require_once __DIR__.'/../view/usuarios.php';
	//require_once __DIR__.'/../model/usuario.php';

class usuario{
	private $nombre;
	private $apPat;
	private $apMat;
	private $dni;
	private $pass;
	private $estado;
	private $zona;
	private $objPDO;

	public function __construct(){
		$this->objPDO = new cado();
	}
	public function retornaNombre($dni){
		$conexion=new cado();
		$conexion->conectar();
		$sql="SELECT emp_nombres,emp_appaterno,emp_apmaterno FROM empleados WHERE emp_dni='".$dni."'";
		$rs=pg_query($sql);
		if(pg_num_rows($rs)==1){
			if($row=pg_fetch_array($rs)){
				$nombre=$row['emp_nombres'];
				$apPat=$row['emp_appaterno'];
				$apMat=$row['emp_apmaterno'];
			}
		}
		$nombreCom = $nombre.' '.$apPat.' '.$apMat;
		return $nombreCom;
	}

	public function listadousarios(){
		$stmt = $this->objPDO->prepare("SELECT * FROM sisesterilizacion.usuario order by id asc");
		$stmt->execute();
		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
		return $ls;
	}

	public function retornaZona($id){
		$conexion=new cado();
		$conexion->conectar();
		$sql="SELECT nombre_zona FROM sisesterilizacion.zona WHERE id_zona='".$id."'";
		$rs=pg_query($sql);
		if(pg_num_rows($rs)==1){
			if($row=pg_fetch_array($rs)){
				$zona=$row['nombre_zona'];
			}
		}
		return $zona;
	}

	public function retornaUsuario($dni){
		$stmt = $this->objPDO->prepare("SELECT * FROM sisesterilizacion.usuario WHERE dni='".$dni."' ");
		$stmt->execute();
		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
		return $ls;
	}

	//mantenimientos
	public function insertarUsuario($dn,$zon,$pass){
		$conexion=new cado();
		$conexion->conectar();
		$sql="INSERT INTO sisesterilizacion.usuario(dni, pass, estado, zona) VALUES ('".$dn."', '".$pass."', 'A', '".$zon."');";
		$rs=pg_query($sql) or die(false);
		return $rs;
	}

	public function cambiarContra($pas,$dni){
		$conexion=new cado();
		$conexion->conectar();
		$p=md5($pas);
		$sql="UPDATE sisesterilizacion.usuario SET pass='$p' WHERE dni='".$dni."' ";
		$rs=pg_query($sql) or die(false);
		return $rs;
	}

	public function actualizarUsuario($zon, $estado,$id){
		$conexion=new cado();
		$conexion->conectar();
		$sql="UPDATE sisesterilizacion.usuario SET estado='$estado', zona='$zon' WHERE id='$id'";
		$rs=pg_query($sql) or die (false);
		return $rs;
	}

	public function eliminarUsuario($id){
		$conexion=new cado();
		$conexion->conectar();
		$sql="DELETE FROM sisesterilizacion.usuario WHERE id='$id'";
		$rs=pg_query($sql) or die (false);
		return $rs;
	}

}

?>
