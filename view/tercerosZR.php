<?php
  require_once 'model/tipoesterilizacion.php';
  $ctr=new tipoesterilizacion();
  $ls=$ctr->listartipos();
?>
<div class="breadcrumbs" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <a href="#">Ingreso de material</a>
            <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
            </span>
        </li>
        <li class="active">Terceros</li>
    </ul><!--.breadcrumb-->
</div>

<div  class="page-content">

    <form class="form-horizontal" >
      <div class="control-group">
        <label class="control-label" for="form-field-1">Centro de procedencia: </label>
        <div class="controls">
          <input type="text" id="centro" placeholder="Centro">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="form-field-1">Responsable: </label>
        <div class="controls">
          <input type="text" id="centro" placeholder="Responsable">
        </div>
      </div>
      <?php require_once("view/html/ZR/buttonsZR.php"); ?>
    </form>
    <?php require_once("view/html/ZR/tablaMat.php") ?>
    <div class="form-actions">
      <button id="material" name="material" class="btn btn-info" type="button" >
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
