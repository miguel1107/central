
<?php
  require_once __DIR__.'/../model/ingresoMaterial.php';
  require_once __DIR__.'/../model/detalleIngMaterial.php';

  /**
   *
   */
  class ctrIngresoMaterial{

    function __construct(){
    }
    //ZR
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
          $rpta = array('estado' => true, );
        }else {
          $rpta = array();
        }
      }else{
        $rpta = array();
      }
      echo count($rpta);
    }

    public function regIngresoMaterialMedico(){
      $mat=($_POST['materiales']);
      $id=$_POST['id'];
      $idrec=$_POST['idrec'];
      $totalPi=$_POST['total'];
      $m=new ingresoMaterial();
      $im=new detalleIngMaterial();
      $rs=$m->registrarMedico($id,$idrec,$totalPi);
      if($rs== "true"){
        $idRec=$m->retornaId();
        $rs2=$im->regIngresoDetalleMat($mat,$idRec);
        if($rs2="true"){
          $rpta = array('estado' => true, );
        }else {
          $rpta = array();
        }
      }else{
        $rpta = array();
      }
      echo count($rpta);
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
      if($rs=="true"){
        $idRec=$m->retornaId();
        $rs2=$im->regIngresoDetalleMat($mat,$idRec);
        if($rs2="true"){
          $rpta = array('estado' => true, );
        }else {
          $rpta = array();
        }
      }else{
        $rpta = array();
      }
      echo count($rpta);
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
      if($rs== "true"){
        $idRec=$m->retornaId();
        $rs2=$im->regIngresoDetalleMat($mat,$idRec);
        if($rs2="true"){
          $rpta = array('estado' => true, );
        }else {
          $rpta = array();
        }
      }else{
        $rpta = array();
      }
      echo count($rpta);
    }

    //ZA
    public function retornaIngresosparaCargaEste(){
      $det=new ingresoMaterial();
      $det=new ingresoMaterial();
      $tipo=$_POST['tipoEste'];
     $ls=$det->listaRecepcionesCargaEsterilizacion($tipo);
      $retur = array();
      $i=0;
      foreach ($ls as $key ) {
        $aux = array();
        $id=$key->id_ingreso;
        $prop=$key->tipo_propietario;
        $ls2=$det->retornaRecpcionDetalleCargaEste($id,$prop);
        foreach ($ls2 as $key2) {
          $iding=$key2->id_ingreso;
          $propi=$key2->prop;
          $fecha=$key2->fecha;
          $descripcion=$key2->descripcion;
          array_push($aux,$iding);
          array_push($aux,$propi);
          array_push($aux,$fecha);
          array_push($aux,$descripcion);
        }
        array_push($retur,$aux);
      }
      echo json_encode($retur);
    }



  }

 ?>
