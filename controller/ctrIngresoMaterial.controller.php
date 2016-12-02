
<?php
  require_once __DIR__.'/../model/ingresoMaterial.php';

  /**
   *
   */
  class ctrIngresoMaterial{

    function __construct(){
    }

    public function regIngresoMaterial(){
      $mat=($_POST['materiales']);
      $id=$_POST['id'];
      $idrec=$_POST['idrec'];
      $idserv=$_POST['idserv'];
      for ($i=0; $i <$mat.length ; $i++) {
        echo $mat[i][0]+"--"+$mat[i][1];
      }
    }
  }

 ?>
