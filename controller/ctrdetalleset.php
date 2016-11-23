<?php
require_once __DIR__.'/../model/detalleset.php';

$accion=$_GET["accion"];
switch ($accion) {
  case 'ver':
  $_SESSION["set"]=$_GET["idSet"];
    header("location:view/detalleSetset");
    break;

  default:
    # code...
    break;
}


?>
