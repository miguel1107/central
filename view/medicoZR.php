<?php
  require_once 'model/tipoesterilizacion.php';
  require_once 'model/empleado.php';
  $ctr=new tipoesterilizacion();
  $ctr1=new empleado();
  $empleado=$ctr1->listaempleados();
  $ls=$ctr->listartipos();
  $id=$_SESSION["idusuario"];
?>
<link rel="stylesheet" href="assets/css/jquery-ui-1.10.3.custom.min.css">
<link rel="stylesheet" href="css/chosen.css" />
<link rel="stylesheet" href="assets/css/chosen.css" />
<div class="breadcrumbs" id="breadcrumbs">
  <div class="progress progress-pink progress-striped active">
    <div class="bar" style="width: 100%"></div>
  </div>
  <ul class="breadcrumb">
    <li>
      <a href="#">Ingreso de material</a>
      <span class="divider">
        <i class="icon-angle-right arrow-icon"></i>
      </span>
    </li>
    <li class="active">Medico</li>
  </ul><!--.breadcrumb-->
</div>
<div  class="page-content">
  <input type="hidden" name="idrecibe" id="idrecibe" value="<?php echo $id; ?>">
  <input type="hidden" name="propietario" id="propietario" value="m">
  <form class="form-horizontal" >
    <div class="control-group">
      <label class="control-label" for="form-field-1">Pesona que entrega: </label>
      <div class="controls">
        <select class="chosen-select" id="empleado" name="empleado" data-placeholder="empleado" style="display: none;">
          <option value=""></option>
        <?php
          foreach ($empleado as $em) {
        ?>
        <option value="<?php echo $em->emp_id ?>"> <?php echo $em->nombres; ?></option>
        <?php
          }
        ?>
        </select>
        <!-- <input type="text" id="empleado" placeholder="Empleado"> -->
      </div>
      <div class="controls">
        <!-- <input readonly="" type="text" id="form-input-readonly" value="Dni">
        <input readonly="" type="hidden" id="idempleado"> -->
      </div>
    </div>
    <?php require_once("view/html/ZR/buttonsZR.php"); ?>
  </form>
  <?php require_once("view/html/ZR/tablaMat.php") ?>
  <div class="control-group">
    <label class="control-label" for="form-field-1" >Total Piezas: </label>
    <div class="controls">
      <input type="text" id="cantidadPz" disabled="true" value="0">
    </div>
  </div>
  <div class="form-actions">
    <button id="material" name="material" class="btn btn-info" type="button" onclick="guardarMedicos()" >
      <i class="icon-ok bigger-110"></i>Ingresar
    </button>
    <button name="material" class="btn btn-danger" type="button" onclick="cancelar()">
      <i class="icon-ok bigger-110"></i>Cancelar
    </button>
  </div>
</div>

<?php require_once ("view/html/ZR/modDetalleSetKit.php") ?>
<?php require_once ("view/html/ZR/modingresomatZR.php") ?>
<?php require_once ("view/alerts.php") ?>

<script src="assets/js/jquery-2.0.3.min.js"></script>
<script src="js/chosen.jquery.min.js"></script>
<script src="assets/js/jquery-ui-1.10.3.custom.min.js"></script>

<script src="js/ZR/app.js"></script>
<script src="js/ZR/autocompletes.js"></script>
<script src="js/ZR/servicios.js"></script>
<!--<script src="js/jquery-3.1.1.min.js"></script>-->
<link rel="stylesheet" type="text/css" href="css/autocomplete.css">
<script>
  $(document).ready(function(){
    window.IngresoMaterial.combo = <?php echo json_encode($ls); ?>;
    window.IngresoMaterial.init();
  });
</script>
<script type="text/javascript">
$(function () {
  $(".chosen-select").chosen({width: "290px"});

})
</script>
