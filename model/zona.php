<?php 
/**
* 
*/
class zona {
	
	function __construct(){
	}


	public function retornaId($no){
		$conexion=new cado();
		$conexion->conectar();
		$sql="SELECT id_zona FROM sisesterilizacion.zona WHERE nombre_zona='".$no."'";
		$rs=pg_query($sql);
		if(pg_num_rows($rs)==1){
			if($row=pg_fetch_array($rs)){
				$zona=$row['id_zona'];
			}
		}
		return $zona;
	}
}


?>