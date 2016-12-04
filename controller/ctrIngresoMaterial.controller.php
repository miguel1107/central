
<?php
  require_once __DIR__.'/../model/ingresoMaterial.php';
  require_once __DIR__.'/../model/detalleIngMaterial.php';

  /**
   *
   */
  class ctrIngresoMaterial{

    function __construct(){
    }

    public function regIngresoMaterialServicio(){
      $mat=($_POST['materiales']);
      $id=$_POST['id'];
      $idrec=$_POST['idrec'];
      $idserv=$_POST['idserv'];
      $totalPi=$_POST['total'];
      $m=new ingresoMaterial();
      $im=new detalleIngMaterial();
      $rs=$m->registrarServicio($id,$idrec,$totalPi,$idserv);
      if($rs== true){
        $idRec=$m->retornaId();
        $rs2=$im->regIngresoDetalleMat($mat,$idRec);
        echo $rs2;
      }
    }

  }

 ?>
