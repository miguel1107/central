
<?php
  require_once __DIR__.'/../model/ingresoMaterial.php';

  /**
   *
   */
  class ctrIngresoMaterial{

    function __construct(){
    }

    public function regIngresoMaterial(){
      $mat=json_decode($_post['materiales']);
      echo $mat;
    }
  }

 ?>
