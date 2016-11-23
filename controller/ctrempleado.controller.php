<?php


require_once __DIR__.'/../model/empleado.php';
/**
 *
 */
class ctrempleado{

  function __construct(){
  }

  public function autocomplete(){
    $filtroTrabajador = strtoupper($_REQUEST['term']);
    $newTrabajadores = '%'.$filtroTrabajador.'%';
    $em = new empleado();
    $listaempleados = $em->listaempleados($newTrabajadores);

    foreach ($listaempleados as $key => $val) {
      $val->label = $val->nombres;
    }

    echo json_encode($listaempleados);
  }

}

?>
