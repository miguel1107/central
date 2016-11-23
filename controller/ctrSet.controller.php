<?php

require_once __DIR__.'/../model/set.php';

/**
 *
 */
class ctrSet{

  function __construct(){
  }

  public function editar(){
    $idmat=$_REQUEST["idmat"];
    $num=$_REQUEST["numnew"];
    $idset=$_REQUEST["idset"];
    // echo "material->".$idmat."set-> ". $idset."numero ".$num;
    $oSet=new set();
    $a=$oSet->modificar($idset,$idmat,$num);
    if( $a==0){
        header('Location: inicio.php?menu=set');
    }
  }

  public function autocomplete(){
		$filtroset = strtoupper($_REQUEST['term']);
		$newset = '%'.$filtroset.'%';
		$em = new set ();
		$listaset = $em->listaetauto($newset);
		foreach ($listaset as $key => $val) {
			$val->label = $val->nombre_set;
		}
		echo json_encode($listaset);
	}

}

 ?>
