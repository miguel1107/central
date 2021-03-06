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
//ZR-Carga ultrazonica
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

//ZR-carga Lavadora

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

  public function entraSaleLav($iding,$estado,$tipo){
    $conexion=new cado();
		$conexion->conectar();
    if ($tipo=="LA") {
      $sql="UPDATE sisesterilizacion.ingreso_material SET ubicacion='LAV', estado='".$estado."' WHERE id_ingreso='".$iding."'; ";
    }else if ($tipo=="LS") {
      $sql="UPDATE sisesterilizacion.ingreso_material SET ubicacion='SEC', estado='".$estado."' WHERE id_ingreso='".$iding."'; ";
    }
    $rs=pg_query($sql) or die(false);
  }

  public function entraSaleLavac($iding,$estado){
    $conexion=new cado();
		$conexion->conectar();
    $sql="UPDATE sisesterilizacion.ingreso_material SET estado='".$estado."' WHERE id_ingreso='".$iding."'; ";
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
        $this->entraSaleLavac($idIng,'T');
      }
    }
  }

//ZR-carga secdora

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

  //ZA-empaquetado
  public function listaRecepcionesEmpaquetado(){
    $stmt = $this->objPDO->prepare("SELECT id_ingreso,tipo_propietario FROM sisesterilizacion.ingreso_material WHERE ubicacion='SEC' and estado='T' order by fecha_ingreso");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
  }

  public function retornaRecpcionEmpaquetado($id,$prop){
    if ($prop=='S') {
      $stmt = $this->objPDO->prepare("SELECT fecha_ingreso as fecha,tipo_propietario as prop,nombre_servicio as descripcion FROM sisesterilizacion.ingreso_material im inner join sisesterilizacion.servicio on im.id_servicio=sisesterilizacion.servicio.id_servicio where ubicacion='SEC' and estado='T'  and id_ingreso='".$id."'; ");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
    if($prop=='M'){
      $stmt = $this->objPDO->prepare("SELECT fecha_ingreso as fecha,tipo_propietario as prop,(emp_appaterno||' '|| emp_apmaterno||','|| emp_nombres) as descripcion FROM sisesterilizacion.ingreso_material im inner join empleados em on em.emp_id=im.id_ingresa where ubicacion='SEC' and estado='T' and id_ingreso='".$id."'");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
    if($prop=='T'){
      $stmt = $this->objPDO->prepare("SELECT fecha_ingreso as fecha,tipo_propietario as prop,(centro_procedencia||'->'||responsable) as descripcion FROM sisesterilizacion.ingreso_material where ubicacion='SEC' and estado='T' and id_ingreso='".$id."'");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
    if($prop=='C'){
      $stmt = $this->objPDO->prepare("SELECT fecha_ingreso as fecha, tipo_propietario as prop,(responsable|| '->'||centro_medico) as descripcion FROM sisesterilizacion.ingreso_material where ubicacion='SEC' and estado='T' and id_ingreso='".$id."'");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
  }

  public function actualizaEmpaqueTotal($iding){
    $conexion=new cado();
    $conexion->conectar();
    $sql="UPDATE sisesterilizacion.ingreso_material SET ubicacion='EMP', estado='T' WHERE id_ingreso='".$iding."'; ";
    $rs=pg_query($sql) or die(false);

  }

  //ZA-cargaEsterilizacion
  public function listaRecepcionesCargaEsterilizacion($tipo){
    $stmt = $this->objPDO->prepare("SELECT distinct (im.id_ingreso), im.tipo_propietario from sisesterilizacion.detalle_ingmaterial dim
    inner join sisesterilizacion.ingreso_material im on dim.id_ingreso_material=im.id_ingreso
    where dim.codigo_est='".$tipo."' and dim.ubicacion='EMP' and procesoza='T' and dim.falta_cargareste>0 order by im.id_ingreso");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
  }

  public function listaRecepcionesCargaEsterilizacionInicio(){
    $stmt = $this->objPDO->prepare("SELECT distinct (im.id_ingreso), im.tipo_propietario from sisesterilizacion.detalle_ingmaterial dim
    inner join sisesterilizacion.ingreso_material im on dim.id_ingreso_material=im.id_ingreso
    where dim.ubicacion='EMP' and procesoza='T' order by im.id_ingreso");
    $stmt->execute();
    $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
    return $ls;
  }


  public function retornaRecpcionDetalleCargaEste($id,$prop){
    if ($prop=='S') {
      $stmt = $this->objPDO->prepare("SELECT id_ingreso,fecha_ingreso as fecha,tipo_propietario as prop,nombre_servicio as descripcion FROM sisesterilizacion.ingreso_material im inner join sisesterilizacion.servicio on im.id_servicio=sisesterilizacion.servicio.id_servicio where ubicacion='EMP' and estado='T'  and id_ingreso='".$id."'; ");
      $stmt->execute();
      $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
      return $ls;
    }
    if($prop=='M'){
      $stmt = $this->objPDO->prepare("SELECT id_ingreso,fecha_ingreso as fecha,tipo_propietario as prop,(emp_appaterno||' '|| emp_apmaterno||','|| emp_nombres) as descripcion FROM sisesterilizacion.ingreso_material im inner join empleados em on em.emp_id=im.id_ingresa where ubicacion='EMP' and estado='T' and id_ingreso='".$id."'");
      $stmt->execute();
      $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
      return $ls;
    }
    if($prop=='T'){
      $stmt = $this->objPDO->prepare("SELECT id_ingreso,fecha_ingreso as fecha,tipo_propietario as prop,(centro_procedencia||'->'||responsable) as descripcion FROM sisesterilizacion.ingreso_material where ubicacion='EMP' and estado='T' and id_ingreso='".$id."'");
      $stmt->execute();
      $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
      return $ls;
    }
    if($prop=='C'){
      $stmt = $this->objPDO->prepare("SELECT id_ingreso,fecha_ingreso as fecha, tipo_propietario as prop,(responsable|| '->'||centro_medico) as descripcion FROM sisesterilizacion.ingreso_material where ubicacion='EMP' and estado='T' and id_ingreso='".$id."'");
      $stmt->execute();
      $ls=$stmt->fetchAll(PDO::FETCH_OBJ);
      return $ls;
    }
  }
  public function inicioCargaCargaEste(){
    $ls=$this->listaRecepcionesCargaEsterilizacionInicio();
    $det=new detalleIngMaterial();
    foreach ($ls as $l) {
      $idIng=$l->id_ingreso;
      $ls2=$det->retornaCantidadDetalleVarlorEste($idIng);//falta
      $ls3=$det->retornaCantidadDetallaEste($idIng);//falta
      if (($ls2)==($ls3)) {
        $this->actualizaCargaEsteTotal($idIng);
        $det->actualizaCargaEstetadoTotal($idIng);
      }
    }
  }

  public function actualizaCargaEsteTotal($iding){
    $conexion=new cado();
    $conexion->conectar();
    $sql="UPDATE sisesterilizacion.ingreso_material SET ubicacion='EST', estado='P' WHERE id_ingreso='".$iding."'; ";
    $rs=pg_query($sql) or die(false);
  }

  //ZV- descarga esterilizador

  public function inicioDescargaEste(){
    $ls=$this->listaRecepcionesCargaEsterilizacionInicio();
    $det=new detalleIngMaterial();
    foreach ($ls as $l) {
      $idIng=$l->id_ingreso;
      $ls2=$det->retornaCantidadDetalleVarlorEste($idIng);//falta
      $ls3=$det->retornaCantidadDetallaEste($idIng);//falta
      if (($ls2)!=($ls3)) {
        $this->actualizaDescargaEsteTotal($idIng);
      }
    }
  }

  public function actualizaDescargaEsteTotal($iding){
    $conexion=new cado();
    $conexion->conectar();
    $sql="UPDATE sisesterilizacion.ingreso_material SET ubicacion='EMP', estado='T' WHERE id_ingreso='".$iding."'; ";
    $rs=pg_query($sql) or die(false);
  }

  public function retornaRecpcionDetalleDescargaEste($id,$prop){
    if ($prop=='S') {
      $stmt = $this->objPDO->prepare("SELECT id_ingreso,fecha_ingreso as fecha,tipo_propietario as prop,nombre_servicio as descripcion FROM sisesterilizacion.ingreso_material im inner join sisesterilizacion.servicio on im.id_servicio=sisesterilizacion.servicio.id_servicio where ubicacion='EST' and estado='P'  and id_ingreso='".$id."'; ");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
    if($prop=='M'){
      $stmt = $this->objPDO->prepare("SELECT id_ingreso,fecha_ingreso as fecha,tipo_propietario as prop,(emp_appaterno||' '|| emp_apmaterno||','|| emp_nombres) as descripcion FROM sisesterilizacion.ingreso_material im inner join empleados em on em.emp_id=im.id_ingresa where ubicacion='EST' and estado='P' and id_ingreso='".$id."'");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
    if($prop=='T'){
      $stmt = $this->objPDO->prepare("SELECT id_ingreso,fecha_ingreso as fecha,tipo_propietario as prop,(centro_procedencia||'->'||responsable) as descripcion FROM sisesterilizacion.ingreso_material where ubicacion='EST' and estado='P' and id_ingreso='".$id."'");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
    if($prop=='C'){
      $stmt = $this->objPDO->prepare("SELECT id_ingreso,fecha_ingreso as fecha, tipo_propietario as prop,(responsable|| '->'||centro_medico) as descripcion FROM sisesterilizacion.ingreso_material where ubicacion='EST' and estado='P' and id_ingreso='".$id."'");
      $stmt->execute();
  		$ls=$stmt->fetchAll(PDO::FETCH_OBJ);
  		return $ls;
    }
  }

}

  ?>
