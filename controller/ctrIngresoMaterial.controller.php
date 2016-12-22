
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
      $rpta = array();
      $mat=($_POST['materiales']);
      $id=$_POST['id'];
      $idrec=$_POST['idrec'];
      $idserv=$_POST['idserv'];
      $totalPi=$_POST['total'];
      $m=new ingresoMaterial();
      $im=new detalleIngMaterial();
      $rs=$m->registrarServicio($id,$idrec,$totalPi,$idserv);
      if($rs=="true"){
        $idRec=$m->retornaId();
        $rs2=$im->regIngresoDetalleMat($mat,$idRec);
        if($rs2="true"){
          $rpta[0]="true";
        }else {
          $rpta[0]="false";
        }
      }else{
        $rpta[0]="false";
      }
      echo json_encode($rpta);
    }

    public function regIngresoMaterialMedico(){
      $mat=($_POST['materiales']);
      $id=$_POST['id'];
      $idrec=$_POST['idrec'];
      $totalPi=$_POST['total'];
      $m=new ingresoMaterial();
      $im=new detalleIngMaterial();
      $rs=$m->registrarMedico($id,$idrec,$totalPi);
      if($rs== true){
        $idRec=$m->retornaId();
        $rs2=$im->regIngresoDetalleMat($mat,$idRec);
        echo $rs2;
      }else{
        echo $rs;
      }
    }

    public function regIngresoMaterialTerceros(){
      $mat=($_POST['materiales']);
      $cen=$_POST['centro'];
      $res=$_POST['res'];
      $idrec=$_POST['idrec'];
      $totalPi=$_POST['total'];
      $m=new ingresoMaterial();
      $m=new ingresoMaterial();
      $im=new detalleIngMaterial();
      $rs=$m->registrarTerceros($idrec,$totalPi,$cen,$res);
      if($rs== true){
        $idRec=$m->retornaId();
        $rs2=$im->regIngresoDetalleMat($mat,$idRec);
        echo $rs2;
      }else{
        echo $rs;
      }
    }

    public function regIngresoMaterialCasaComercial(){
      $mat=($_POST['materiales']);
      $cen=$_POST['centro'];
      $res=$_POST['res'];
      $idrec=$_POST['idrec'];
      $totalPi=$_POST['total'];
      $m=new ingresoMaterial();
      $im=new detalleIngMaterial();
      $rs=$m->registrarCasaComercial($idrec,$totalPi,$res,$cen);
      if($rs== true){
        $idRec=$m->retornaId();
        $rs2=$im->regIngresoDetalleMat($mat,$idRec);
        echo $rs2;
      }else{
        echo $rs;
      }
    }

  }

 ?>
