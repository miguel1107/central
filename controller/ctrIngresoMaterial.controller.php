
<?php
  require_once __DIR__.'/../model/ingresoMaterial.php';

  /**
   *
   */
  class ctrIngresoMaterial{

    function __construct(){
    }

    public function regIngresoMaterial(){
      $mat=json_decode($_POST['materiales']);
      $id=$_POST['id'];
      $idrec=$_POST['idrec'];
      $idserv=$_POST['idserv'];
      echo $mat;
    }
  }

 ?>
