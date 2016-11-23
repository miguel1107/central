<?php
  require_once 'model/set.php';
  $ctr=new set();
  $ls=$ctr->listadoset();
?>

<div class="breadcrumbs" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <a href="#">Mantenimientos</a>
            <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
            </span>
        </li>
        <li class="active">Set de materiales</li>
    </ul>
</div>
<div  class="page-content">
  <div class="row-fluid">
    <div class="span12">
      <!-- <input type="hidden" id="idset" name="idset" value=""> -->
      <h2 class="header smaller lighter blue">Set de materiales</h2>
      <div class="span12">
        <div class="span10">
          <select name="SelectTipo" id="selectTipo">
            <option>--Seleccion Set--</option>
            <?php
        		foreach ($ls as $lsSet) {
        		?>
        		<option  onclick="llenatabla()" value=<?php  echo $lsSet->id_set; ?>><?php echo $lsSet->nombre_set; ?></option>
        		<?php } ?>
          </select>
        </div>
        <div class="span2">
          <a class="btn btn-app btn-mini btn-primary" data-toggle="modal" data-target="#modalNuevo" id="nuevo-set" >Nuevo</a>
        </div>
      </div>
      <br><br><br>
      <div  class="table-responsive">
        <div class="table-header">Detalles de Set</div>
        <table id ="tabladet"  name="tabladet"   class="table table-striped table-bordered table-hover dataTable dt-responsive"  cellspacing="0" width="100%">
          <!--La tabla esta en view/html/tabladetalleset.php-->

          <!-- -->
        </table>
      </div>  <!-- table-responsive -->
    </div><!-- span12 -->
  </div><!-- row-f -->
</div>


<!-- modal -->
<div id="modiSet" class="modal fade" role="dialog">
	<form id="modi" class="form-horizontal" method="post" action="index.php?c=ctrSet&a=editar">
    <div class="modal-header">
      <h4 class="modal-title">Modificar Set</h4>
    </div><br>
    <input type="hidden" id="idmat" name="idmat">
    <input type="hidden" id="idset" name="idset">
    <div class="control-group">
      <label class="control-label" for="form-field-1"> Numero de material </label>
      <div class="controls">
        <input type="text" name="numnew" id="numnew">
      </div>
    </div>
    <div class="form-actions">
      <input type="submit" class="btn btn-info" value="Guardar" id="btn-save">
      <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
    </div>
	</form>
</div>

<div id="newSet" class="modal fade" role="dialog">
	<form id="modi" class="form-horizontal" method="post" action="index.php?c=ctrSet&a=editar">
    <div class="modal-header">
      <h4 class="modal-title">Nuevo Set</h4>
    </div><br>
    <input type="hidden" id="idmat" name="idmat">
    <input type="hidden" id="idset" name="idset">
    <div class="control-group">
      <label class="control-label" for="form-field-1"> Numero de material </label>
      <div class="controls">
        <input type="text" name="numnew" id="numnew">
      </div>
    </div>
    <div class="form-actions">
      <input type="submit" class="btn btn-info" value="Guardar" id="btn-save">
      <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
    </div>
	</form>
</div>
