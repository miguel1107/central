<?php
 require_once __DIR__.'/../model/materialQuirurgico.php';
 /**
  *
  */
 class ctrMaterial{

 	function __construct(){
 	}

	public function autocomplete(){
		$filtromat = strtoupper($_REQUEST['term']);
		$newmat = '%'.$filtromat.'%';
		$em = new materialQuirurgico ();
		$listamat = $em->listasautocomplete($newmat);
		foreach ($listamat as $key => $val) {
			$val->label = $val->material;
		}
		echo json_encode($listamat);
	}
 }

?>
