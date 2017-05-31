<?php
require_once 'cado.php';

/**
 *
 */
class kit{

  private $objPdo;

  function __construct(){
    $this->objPdo = new cado();
  }

  public function registrarKit($nombre,$idrec,$totalkit){
    $conexion=new cado();
		$conexion->conectar();
		$sql="INSERT INTO sisesterilizacion.kit(descripcion, num_materiales,id_recibe)VALUES ('".$nombre."', '".$totalkit."','".$idrec."');";
		$rs=pg_query($sql) or die(false);
    if ($rs==true) {
      return true;
    }else{
      return false;
    }
  }

  public function retornaId(){
    $conexion=new cado();
		$conexion->conectar();
    $sql="SELECT max(id_kit) as kit from sisesterilizacion.kit";
    $rs=pg_query($sql);
    if(pg_num_rows($rs)==1){
			if($row=pg_fetch_array($rs)){
				$id=$row[0];
			}
		}
    return $id;
  }

  public function listasautocomplete($kit){
    $stmt = $this->objPdo->prepare("SELECT *  FROM sisesterilizacion.kit WHERE descripcion LIKE :kit LIMIT 5");
    $stmt->execute(array('kit'=>$kit));
    $lskit = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $lskit;
  }
}

?>
