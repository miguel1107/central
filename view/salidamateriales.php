<?php
require_once 'model/servicio.php';
require_once 'model/empleado.php';
$ctr2=new servicio();
$ctr1=new empleado();
$servicio=$ctr2->listadoServicio();
$empleado=$ctr1->listaempleados();
$id=$_SESSION["idusuario"];
?>

<link rel="stylesheet" href="assets/css/jquery-ui-1.10.3.custom.min.css">
<link rel="stylesheet" href="css/chosen.css" />
<link rel="stylesheet" href="assets/css/chosen.css" />
<div class="breadcrumbs" id="breadcrumbs">
  <ul class="breadcrumb">
      <li>
          <a href="#">Salida de material</a>
          <span class="divider">
              <i class="icon-angle-right arrow-icon"></i>
          </span>
      </li>
      <li class="active">Salida de Material</li>
  </ul><!--.breadcrumb-->
</div>
<div class="page-content">
  <div class="row-fluid">
    <form class="form-horizontal">
      <div class="control-group">
        <label class="control-label" for="form-field-1">Servicio: </label>
        <div class="controls">
          <select class="chosen-select" id="servicio" name="servicio" data-placeholder="Servicio" required="required" onchange="escojeservicio()">
            <option value=""></option>
            <?php
              foreach ($servicio as $ser) {
            ?>
            <option value="<?php echo $ser->id_servicio ?>"> <?php echo $ser->nombre_servicio; ?></option>
            <?php
              }
            ?>
          </select>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="form-field-1">Empleado: </label>
        <div class="controls">
          <select class="chosen-select" id="empleado" name="empleado" data-placeholder="Empleado" required="required">
            <option value=""></option>
            <?php
              foreach ($empleado as $em) {
            ?>
            <option value="<?php echo $em->emp_id ?>"> <?php echo $em->nombres; ?></option>
            <?php
              }
            ?>
          </select>
        </div>
      </div>
    </form>
    <div class="table-responsive">
      <div class="table-header">
        Recepciones para carga
      </div>
      <table id="sample-table-2" class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th>Id</th>
            <th>Fecha de Recepción</th>
            <th>Propietario</th>
            <th>Descripcion</th>
            <th>Accion</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
</div>
<script src="assets/js/jquery-2.0.3.min.js"></script>
<script src="js/chosen.jquery.min.js"></script>
<script src='assets/js/jquery.mobile.custom.min.js'></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/jquery.dataTables.bootstrap.js"></script>
<script src="assets/js/ace-elements.min.js"></script>
<script src="assets/js/ace.min.js"></script>
<script src="js/ZV/salidamateriales.js"></script>
<script src="js/ZV/appSalidamateriales.js"></script>
<script type="text/javascript">

  $(function () {
    $(".chosen-select").chosen({width: "290px"});
    var oTable1 = $('#sample-table-2').dataTable();

  });
  $(document).ready(function(){
    window.salidamateriales.init();
  });
</script>
