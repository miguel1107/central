<?php
require_once "cado.php";
require_once "detalleIngMaterial.php";

/**
 *
 */
class ingresoMaterial{
  private $objPDO;

  function __construct(){
    $this->objPDO = new cado();
  }

  //ZR-Registro de material
  public function registrarServicio($idIngresa,$idRecibe,$total,$idServicio){
    $conexion=new cado();
		$conexion->conectar();
    $fecha=$this->fecha();
		$sql="INSERT INTO sisesterilizacion.ingreso_material(id_ingresa,id_recibe,total_piezas,estado,tipo_propietario,ubicacion,fecha_ingreso,id_servicio) VALUES ('$idIngresa','$idRecibe','$total','P','S','REC','$fecha','$idServicio');";
		$rs=pg_query($sql) or die(false);
    if ($rs==true) {
      return "true";
    }else{
      return "false";
    }
  }

  public function registrarMedico($idIngresa,$idRecibe,$total){
    $conexion=new cado();
		$conexion->conectar();
    $fecha=$this->fecha();
		$sql="INSERT INTO sisesterilizacion.ingreso_material(id_ingresa,id_recibe,total_piezas,estado,tipo_propietario,ubicacion,fecha_ingreso) VALUES ('$idIngresa','$idRecibe','$total','P','M','REC','$fecha');";
		$rs=pg_query($sql) or die(false);
    if ($rs==true) {
      return "true";
    }else{
      return "false";
    }
  }

  public function registrarTerceros($idRecibe,$total,$cen,$res){
    $conexion=new cado();
		$conexion->conectar();
    $fecha=$this->fecha();
		$sql="INSERT INTO sisesterilizacion.ingreso_material(id_recibe,total_piezas,estado,tipo_propietario,centro_procedencia,responsable,ubicacion,fecha_ingreso) VALUES ('$idRecibe','$total','P','T','$cen','$res','REC','$fecha');";
		$rs=pg_query($sql) or die(false);
    if ($rs==true) {
      return "true";
    }else{
      return "false";
    }
  }

  public function registrarCasaComercial($idRecibe,$total,$res,$cen){
    $conexion=new cado();
		$conexion->conectar();
    $fecha=$this->fecha();
		$sql="INSERT INTO sisesterilizacion.ingreso_material(id_recibe,total_piezas,estado,tipo_propietario,responsable,centro_medico,ubicacion,fecha_ingreso) VALUES ('$idRecibe','$total','P','C','$res','$cen','REC','$fecha');";
		$rs=pg_query($sql) or die(false);
    return $rs;
    if ($rs==true) {
      return "true";
    }else{
      return "false";
    }
  }

//---
  public function fecha(){
    $conexion=new cado();
    $conexion->conectar();
    $sql="SELECT TIMESTAMP 'now'";
    $rs=pg_query($sql);
    if(pg_num_rows($rs)==1){
      if($row=pg_fetch_array($rs)){
        $fecha=$row[0];
      }
    }
    return $fecha;
  }
//---
//Carga ultrazonica
  public function listaRecepcionesDisponibles(){
    $stmt = $this->objPDO->prepare("SELECT id_ingreso,tipo_propietario FROM sisesterilizacion.ingreso_material where ubicacion='REC' order by fecha_ingreso");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
  }

  public function listaRecepcionesEnProceso(){
    $stmt = $this->objPDO->prepare("SELECT id_ingreso,tipo_propietario FROM sisesterilizacion.ingreso_material where ubicacion='ULT' and estado='P' order by fecha_ingreso");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
  }

  public function retornaId(){
    $conexion=new cado();
		$conexion->conectar();
    $sql="SELECT max(id_ingreso) as recepcion from sisesterilizacion.ingreso_material";
    $rs=pg_query($sql);
    if(pg_num_rows($rs)==1){
			if($row=pg_fetch_array($rs)){
				$id=$row[0];
			}
		}
    return $id;
  }

  public function retornaRecpcion($id,$prop){
    if ($prop=='S') {
      $stmt = $this->objPDO->prepare("SELECT fecha_ingreso as fecha,tipo_propietario as prop,nombre_servicio as descripcion FROM sisesterilizacion.ingreso_material im inner join sisesterilizacion.servicio on im.id_servicio=sisesterilizacion.servicio.id_servicio where ubicacion='REC'  and id_ingreso='".$id."'; ");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
    if($prop=='M'){
      $stmt = $this->objPDO->prepare("SELECT fecha_ingreso as fecha,tipo_propietario as prop,(emp_appaterno||' '|| emp_apmaterno||','|| emp_nombres) as descripcion FROM sisesterilizacion.ingreso_material im inner join empleados em on em.emp_id=im.id_ingresa where ubicacion='REC' and id_ingreso='".$id."'");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
    if($prop=='T'){
      $stmt = $this->objPDO->prepare("SELECT fecha_ingreso as fecha,tipo_propietario as prop,(centro_procedencia||'->'||responsable) as descripcion FROM sisesterilizacion.ingreso_material where ubicacion='REC' and id_ingreso='".$id."'");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
    if($prop=='C'){
      $stmt = $this->objPDO->prepare("SELECT fecha_ingreso as fecha, tipo_propietario as prop,(responsable|| '->'||centro_medico) as descripcion FROM sisesterilizacion.ingreso_material where ubicacion='REC' and id_ingreso='".$id."'");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
  }

  public function retornaRecpcionProceso($id,$prop){
    if ($prop=='S') {
      $stmt = $this->objPDO->prepare("SELECT fecha_ingreso as fecha,tipo_propietario as prop,nombre_servicio as descripcion FROM sisesterilizacion.ingreso_material im inner join sisesterilizacion.servicio on im.id_servicio=sisesterilizacion.servicio.id_servicio where ubicacion='ULT' and estado='P' and id_ingreso='".$id."'; ");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
    if($prop=='M'){
      $stmt = $this->objPDO->prepare("SELECT fecha_ingreso as fecha,tipo_propietario as prop,(emp_appaterno||' '|| emp_apmaterno||','|| emp_nombres) as descripcion FROM sisesterilizacion.ingreso_material im inner join empleados em on em.emp_id=im.id_ingresa where ubicacion='ULT'and estado='P' and id_ingreso='".$id."'");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
    if($prop=='T'){
      $stmt = $this->objPDO->prepare("SELECT fecha_ingreso as fecha,tipo_propietario as prop,(centro_procedencia||'->'||responsable) as descripcion FROM sisesterilizacion.ingreso_material where ubicacion='ULT'and estado='P' and id_ingreso='".$id."'");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
    if($prop=='C'){
      $stmt = $this->objPDO->prepare("SELECT fecha_ingreso as fecha, tipo_propietario as prop,(responsable|| '->'||centro_medico) as descripcion FROM sisesterilizacion.ingreso_material where ubicacion='ULT'and estado='P' and id_ingreso='".$id."'");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
  }

  public function entraSaleUltra($iding,$estado){
    $conexion=new cado();
		$conexion->conectar();
    $sql="UPDATE sisesterilizacion.ingreso_material SET ubicacion='ULT', estado='".$estado."' WHERE id_ingreso='".$iding."'; ";
    $rs=pg_query($sql) or die(false);
  }

  public function inicioUltrazonica(){
    $det=new detalleIngMaterial();
    $ls=$this->listaRecepcionesEnProceso();
    foreach ($ls as $l) {
      $idIng=$l->id_ingreso;
      $ls2=$det->retornaCantidadDetalleValor($idIng);
      $ls3=$det->retornaCantidadDetalle($idIng);
      if (($ls2)==($ls3)) {
        $this->entraSaleUltra($idIng,'T');
      }
    }
  }

//carga Lavadora

  public function listaRepcionesParaLavadora()  {
    $stmt = $this->objPDO->prepare("SELECT id_ingreso,tipo_propietario FROM sisesterilizacion.ingreso_material WHERE ubicacion='ULT' and estado='T' order by fecha_ingreso");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
  }

  public function listaRecepcionesEnProcesoLav(){
    $stmt = $this->objPDO->prepare("SELECT id_ingreso,tipo_propietario FROM sisesterilizacion.ingreso_material WHERE ubicacion='LAV' and estado='P' order by fecha_ingreso");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
  }

  public function retornaRecpcionLavadora($id,$prop){
    if ($prop=='S') {
      $stmt = $this->objPDO->prepare("SELECT fecha_ingreso as fecha,tipo_propietario as prop,nombre_servicio as descripcion FROM sisesterilizacion.ingreso_material im inner join sisesterilizacion.servicio on im.id_servicio=sisesterilizacion.servicio.id_servicio where ubicacion='ULT' and estado='T'  and id_ingreso='".$id."'; ");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
    if($prop=='M'){
      $stmt = $this->objPDO->prepare("SELECT fecha_ingreso as fecha,tipo_propietario as prop,(emp_appaterno||' '|| emp_apmaterno||','|| emp_nombres) as descripcion FROM sisesterilizacion.ingreso_material im inner join empleados em on em.emp_id=im.id_ingresa where ubicacion='ULT' and estado='T' and id_ingreso='".$id."'");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
    if($prop=='T'){
      $stmt = $this->objPDO->prepare("SELECT fecha_ingreso as fecha,tipo_propietario as prop,(centro_procedencia||'->'||responsable) as descripcion FROM sisesterilizacion.ingreso_material where ubicacion='ULT' and estado='T' and id_ingreso='".$id."'");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
    if($prop=='C'){
      $stmt = $this->objPDO->prepare("SELECT fecha_ingreso as fecha, tipo_propietario as prop,(responsable|| '->'||centro_medico) as descripcion FROM sisesterilizacion.ingreso_material where ubicacion='ULT' and estado='T' and id_ingreso='".$id."'");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
  }

  public function retornaRecpcionLavadoraProceso($id,$prop){
    if ($prop=='S') {
      $stmt = $this->objPDO->prepare("SELECT fecha_ingreso as fecha,tipo_propietario as prop,nombre_servicio as descripcion FROM sisesterilizacion.ingreso_material im inner join sisesterilizacion.servicio on im.id_servicio=sisesterilizacion.servicio.id_servicio where ubicacion='LAV' and estado='P'  and id_ingreso='".$id."'; ");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
    if($prop=='M'){
      $stmt = $this->objPDO->prepare("SELECT fecha_ingreso as fecha,tipo_propietario as prop,(emp_appaterno||' '|| emp_apmaterno||','|| emp_nombres) as descripcion FROM sisesterilizacion.ingreso_material im inner join empleados em on em.emp_id=im.id_ingresa where ubicacion='LAV' and estado='P' and id_ingreso='".$id."'");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
    if($prop=='T'){
      $stmt = $this->objPDO->prepare("SELECT fecha_ingreso as fecha,tipo_propietario as prop,(centro_procedencia||'->'||responsable) as descripcion FROM sisesterilizacion.ingreso_material where ubicacion='LAV' and estado='P' and id_ingreso='".$id."'");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
    if($prop=='C'){
      $stmt = $this->objPDO->prepare("SELECT fecha_ingreso as fecha, tipo_propietario as prop,(responsable|| '->'||centro_medico) as descripcion FROM sisesterilizacion.ingreso_material where ubicacion='LAV' and estado='P' and id_ingreso='".$id."'");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
  }

  public function entraSaleLav($iding,$estado){
    $conexion=new cado();
		$conexion->conectar();
    $sql="UPDATE sisesterilizacion.ingreso_material SET ubicacion='LAV', estado='".$estado."' WHERE id_ingreso='".$iding."'; ";
    $rs=pg_query($sql) or die(false);
  }

  public function inicioLavadora(){
    $ls=$this->listaRecepcionesEnProcesoLav();
    $det=new detalleIngMaterial();
    foreach ($ls as $l) {
      $idIng=$l->id_ingreso;
      $ls2=$det->retornaCantidadDetalleVarlorLav($idIng);
      $ls3=$det->retornaCantidadDetallaLav($idIng);
      if (($ls2)==($ls3)) {
        $this->entraSaleLav($idIng,'T');
      }
    }
  }

//carga secdora

  public function listaRepcionesParaSec($value=''){
    $stmt = $this->objPDO->prepare("SELECT id_ingreso,tipo_propietario FROM sisesterilizacion.ingreso_material WHERE ubicacion='LAV' and estado='T' order by fecha_ingreso");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
  }

  public function listaRecepcionesEnProcesoSec(){
    $stmt = $this->objPDO->prepare("SELECT id_ingreso,tipo_propietario FROM sisesterilizacion.ingreso_material WHERE ubicacion='SEC' and estado='P' order by fecha_ingreso");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
  }

  public function retornaRecpcionSecadora($id,$prop){
    if ($prop=='S') {
      $stmt = $this->objPDO->prepare("SELECT fecha_ingreso as fecha,tipo_propietario as prop,nombre_servicio as descripcion FROM sisesterilizacion.ingreso_material im inner join sisesterilizacion.servicio on im.id_servicio=sisesterilizacion.servicio.id_servicio where ubicacion='LAV' and estado='T'  and id_ingreso='".$id."'; ");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
    if($prop=='M'){
      $stmt = $this->objPDO->prepare("SELECT fecha_ingreso as fecha,tipo_propietario as prop,(emp_appaterno||' '|| emp_apmaterno||','|| emp_nombres) as descripcion FROM sisesterilizacion.ingreso_material im inner join empleados em on em.emp_id=im.id_ingresa where ubicacion='LAV' and estado='T' and id_ingreso='".$id."'");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
    if($prop=='T'){
      $stmt = $this->objPDO->prepare("SELECT fecha_ingreso as fecha,tipo_propietario as prop,(centro_procedencia||'->'||responsable) as descripcion FROM sisesterilizacion.ingreso_material where ubicacion='LAV' and estado='T' and id_ingreso='".$id."'");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
    if($prop=='C'){
      $stmt = $this->objPDO->prepare("SELECT fecha_ingreso as fecha, tipo_propietario as prop,(responsable|| '->'||centro_medico) as descripcion FROM sisesterilizacion.ingreso_material where ubicacion='LAV' and estado='T' and id_ingreso='".$id."'");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
  }

  public function retornaRecpcionSecadoraProceso($id,$prop){
    if ($prop=='S') {
      $stmt = $this->objPDO->prepare("SELECT fecha_ingreso as fecha,tipo_propietario as prop,nombre_servicio as descripcion FROM sisesterilizacion.ingreso_material im inner join sisesterilizacion.servicio on im.id_servicio=sisesterilizacion.servicio.id_servicio where ubicacion='SEC' and estado='P'  and id_ingreso='".$id."'; ");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
    if($prop=='M'){
      $stmt = $this->objPDO->prepare("SELECT fecha_ingreso as fecha,tipo_propietario as prop,(emp_appaterno||' '|| emp_apmaterno||','|| emp_nombres) as descripcion FROM sisesterilizacion.ingreso_material im inner join empleados em on em.emp_id=im.id_ingresa where ubicacion='SEC' and estado='P' and id_ingreso='".$id."'");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
    if($prop=='T'){
      $stmt = $this->objPDO->prepare("SELECT fecha_ingreso as fecha,tipo_propietario as prop,(centro_procedencia||'->'||responsable) as descripcion FROM sisesterilizacion.ingreso_material where ubicacion='SEC' and estado='P' and id_ingreso='".$id."'");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
    if($prop=='C'){
      $stmt = $this->objPDO->prepare("SELECT fecha_ingreso as fecha, tipo_propietario as prop,(responsable|| '->'||centro_medico) as descripcion FROM sisesterilizacion.ingreso_material where ubicacion='SEC' and estado='P' and id_ingreso='".$id."'");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
  }

  public function entraSaleSec($iding,$estado){
    $conexion=new cado();
		$conexion->conectar();
    $sql="UPDATE sisesterilizacion.ingreso_material SET ubicacion='SEC', estado='".$estado."' WHERE id_ingreso='".$iding."'; ";
    $rs=pg_query($sql) or die(false);
  }

  public function inicioSecadora(){
    $ls=$this->listaRecepcionesEnProcesoSec();
    $det=new detalleIngMaterial();
    foreach ($ls as $l) {
      $idIng=$l->id_ingreso;
      $ls2=$det->retornaCantidadDetalleVarlorSec($idIng);//falta
      $ls3=$det->retornaCantidadDetallaSec($idIng);//falta
      if (($ls2)==($ls3)) {
        $this->entraSaleSec($idIng,'T');
      }
    }
  }
}

 ?>
