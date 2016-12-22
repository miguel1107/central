<?php
  require_once 'model/tipoesterilizacion.php';
  $ctr=new tipoesterilizacion();
  $ls=$ctr->listartipos();
  $id=$_SESSION["idusuario"];
?>
<div class="breadcrumbs" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <a href="#">Ingreso de material</a>
            <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
            </span>
        </li>
        <li class="active">Servicio</li>
    </ul><!--.breadcrumb-->
</div>
<div  class="page-content">
  <input type="hidden" name="propietario" id="propietario" value="s">
  <input type="hidden" name="idrecibe" id="idrecibe" value=<?php echo $id ?>>
  <form class="form-horizontal" >
    <div class="control-group">
      <label class="control-label" for="form-field-1">Pesona que entrega: </label>
      <div class="controls">
        <input type="text" id="empleado" placeholder="Empleado">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="form-field-1">Dni: </label>
      <div class="controls">
        <input readonly="" type="text" id="form-input-readonly" value="Dni">
        <input readonly="" type="hidden" id="idempleado">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="form-field-1">Servicio: </label>
      <div class="controls">
        <input type="text" id="servicio" placeholder="servicio">
        <input readonly="" type="hidden" id="idservicio" name="idservicio">
      </div>
    </div>
    <?php require_once("view/html/ZR/buttonsZR.php"); ?>
  </form>
    <?php require_once("view/html/ZR/tablaMat.php") ?>
    <div class="control-group">
      <label class="control-label" for="form-field-1" >Total Piezas: </label>
      <div class="controls">
        <input type="text" id="cantidadPz" disabled="true" value='0'>
      </div>
    </div>
    <div class="form-actions">
        <button id="material" name="material" class="btn btn-info" type="button" onclick="guardarServicio()">
              <i class="icon-ok bigger-110"></i>Ingresar
        </button>
    </div>
</div>

<?php require_once ("view/html/ZR/modingresomatZR.php") ?>

<script src="assets/js/jquery-2.0.3.min.js"></script>

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
