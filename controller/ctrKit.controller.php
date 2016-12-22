<?php
require_once __DIR__.'/../model/kit.php';
require_once __DIR__.'/../model/detalleKit.php';

/**
 *
 */
class ctrKit{

  function __construct(){
  }

  public function registroKit(){
      $k=($_POST['k']);
      $idrec=$_POST['idrec'];
      $nomKit=$_POST['nomKit'];
      $totalkit=$_POST['totalKit'];
      $ki=new kit();
      $detKit= new detalleKit();
      $rs=$ki->registrarKit($nomKit,$idrec,$totalkit);
      if($rs=true){
        $idKit=$ki->retornaId();
        $rs2=$detKit->regIngresoDetalleKit($k,$idKit);
        echo $rs2;
      }else{
        echo $rs;
      }
  }

  public function autocomplete(){
		$filtromat = ($_REQUEST['term']);
		$newmat = '%'.$filtromat.'%';
		$kit = new kit ();
		$listakit = $kit->listasautocomplete($newmat);
		foreach ($listakit as $key => $val) {
			$val->label = $val->descripcion;
		}
		echo json_encode($listakit);
	}
}


?>
