<?php
  $id=$_SESSION["idusuario"];
?>
<div class="breadcrumbs" id="breadcrumbs">
  <ul class="breadcrumb">
      <li>
          <a href="#">Zona Azul</a>
          <span class="divider">
              <i class="icon-angle-right arrow-icon"></i>
          </span>
      </li>
      <li class="active">Ingreso de Ropa</li>
  </ul><!--.breadcrumb-->
</div>
<div class="page-content">
  <input type="hidden" name="idrecibe" id="idrecibe" value=<?php echo $id ?>>
  <form class="form-horizontal">
    <div class="control-group">
      <label class="control-label" for="form-field-1">Servicio: </label>
      <div class="controls">
        <input type="text" id="servicio" placeholder="Servicio">
      </div>
    </div>
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
    <div class="form-actions">
      <button id="material" name="material" class="btn btn-info" type="button" onclick="IngresoMaterial.addMaterial();return false">
        <i class="icon-ok bigger-110"></i>Agregar Ropa
      </button>
    </div>
  </form>
</div>



<script src="assets/js/jquery-2.0.3.min.js"></script>
<script src="js/ZR/autocompletes.js"></script>
<link rel="stylesheet" type="text/css" href="css/autocomplete.css">
