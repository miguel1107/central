<?php

require_once "model/cado.php";

$conexion = new cado();
session_start();

$usu=$_POST["usuario"];
$pass=$_POST["pass"];
$zonausu=$_POST['zona'];
$us=$usu;
//echo $usu." " . $pass;
if(empty($usu) or empty($pass)){
	header("location:login.php?msj=Rellene todos los campos");
}else{
	$contra=md5($pass);
	$conexion->conectar();
	//consulta si el usuario esta habilitado para entrar al sistema
	$consulta="SELECT estado,zona FROM sisesterilizacion.usuario WHERE dni='".$usu."' and pass='".$contra."' ";
	//$rs=$conexion->seleccionarDatos($consulta);
	$rs=pg_query($consulta);

	if(pg_num_rows($rs)==0){
		//echo "nohay filas";
		header("location:login.php?msj=el usuaro no existe");
	}else{
		if($row=pg_fetch_array($rs)){
			$esta=$row["estado"];
			$zon=$row["zona"];
			if($esta=='A'){
				$consulta2="SELECT id_zona FROM sisesterilizacion.zona WHERE nombre_zona='".$zonausu."'";
				$rs1=pg_query($consulta2);
				if ($row1=pg_fetch_array($rs1)) {
					$zo=$row1["id_zona"];
					if($zon==$zo){
						$consulta3="SELECT emp_id,emp_nombres,emp_appaterno,emp_apmaterno FROM empleados WHERE emp_dni='".$usu."'";
						$rs2=pg_query($consulta3);
						if($row3=pg_fetch_array($rs2)){
							$idusu=$row3["emp_id"];
							$nomcompleto=$row3["emp_nombres"];
							$_SESSION["nomusuario"]=$nomcompleto;
							$_SESSION["zona"]=$zonausu;
							$_SESSION["navegacion"]="Inicio";
							$_SESSION["dniusuario"]=$us;
							$_SESSION["idusuario"]=$idusu;
							header("location:inicio.php");
						}
					}else{
						header("location:login.php?msj=Zona Incorrecta");
					}
				}

			}else{
				//mensaje usuario desabilitado
				header("location:login.php?msj=Usuario desabilitado");
			}
		}
	}

}

?>
