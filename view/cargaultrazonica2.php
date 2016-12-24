<?php
  require_once 'model/detalleIngMaterial.php';
  require_once 'model/ingresoMaterial.php';
  require_once 'model/ultrazonica.php';
  $ctr=new ingresoMaterial();
  $ctr2=new detalleIngMaterial();
  $ctr3=new ultrazonica();
  $ls=$ctr->listaRecepcionesDisponibles();
  $ctr->inicioUltrazonica();
  $lsu=$ctr3->retornaUltrazonica();
  $lsocu=$ctr3->retornaUltrazonicaOcupadas();
?>

<div class="breadcrumbs" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <a href="#">Ingreso de material</a>
            <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
            </span>
        </li>
        <li class="active">Carga Ultrazonica</li>
    </ul><!--.breadcrumb-->
</div>
<div class="page-content">
  <div class="table-responsive">
    <div class="table-header">
      Recepciones disponibles
    </div>
    <table id="listaRecepciones" class="table table-striped table-bordered table-hover dataTable dt-responsive"  cellspacing="0" width="100%">
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
        <?php
        foreach ($ls as $lsr2){
          $id=$lsr2->id_ingreso;
          $pro=$lsr2->tipo_propietario;
          $ls2=$ctr->retornaRecpcion($id,$pro);
          foreach ($ls2 as $lsr3) {
        ?>
        <tr>
          <td><?php echo $id; ?></td>
          <td><?php
            $fe=date_create($lsr3->fecha);
            echo date_format($fe, 'd-m-Y (H:i:s)'); ?>
          </td>
          <td><?php
            $s=$lsr3->prop;
            if($s=='S'){
              echo "Servicio";
            }elseif ($s=='M') {
              echo "Médico";
            }elseif ($s=='T') {
              echo "Terceros";
            }else {
              echo "Casa Comercial";
            }
            ?>
          </td>
          <td><?php echo $lsr3->descripcion; ?></td>
          <td class="td-actions">
            <div class="action-buttons">
              <a href="javascript" onclick="ver(<?php echo $id ?>)" role="button" class="green" data-toggle="modal">
                <i class="icon-hand-right icon-animated-hand-pointer blue"></i>
              </a>
            </div>
          </td>
        </tr>
        <?php
          }
        }
        ?>
      </tbody>
    </table>
  </div>
  <div class="hr hr32 hr-dotted"></div>
  <div class="row-fluid">
    <div class="span6">
      <div class="widget-box">
        <div class="widget-header">
          <h4 class="smaller">Carga Ultrazonica</h4>
        </div>
        <div class="widget-body">
          <div class="widget-main">
            <table class="table table-striped table-bordered table-hover dataTable dt-responsive">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Tipo</th>
                  <th>Descripcion</th>
                  <th>cantidad</th>
                </tr>
              </thead>
              <tbody id="carUltrazonica">
                <script type="text/template" id="tmpl-carga">
                  <tr>
                    <th class="idCarga"></th>
                    <th class="tipoCarga"></th>
                    <th class="descripcionCarga"></th>
                    <th class="cantidadCarga"></th>
                  </tr>
                </script>
              </tbody>
            </table>
            <hr>
          </div>
        </div>
      </div>
    </div><!--/span-->
    <div class="span6">
      <div class="widget-box">
        <div class="widget-header">
          <h4 class="smaller">Ultrazonicas</h4>
        </div>
        <div class="widget-body">
          <div class="widget-main">
            <div class="control-gropup">
              <label class="control-label" for="form-field-1">ultrazonicas disponibles: </label>
              <div class="controls">
                <select class="redondear" id="ultrazonica" name="ultrazonica">
                  <?php foreach ($lsu as $ultra) { ?>
                    <option value="<?php echo $ultra->id_ultrazonica ?>"> <?php echo $ultra->nombre_ultrazonica; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="control-gropup">
              <label class="control-label" for="form-field-1">ultrazonicas Ocupadas: </label>
              <div class="controls">
                <div class="tags">
                  <?php foreach ($lsocu as $ocupa) { ?>
                    <span class="tag"><?php echo $ocupa->nombre_ultrazonica ?>
                      <button type="button" class="close" onclick="desocupaUltrazonica(<?php echo $ocupa->id_ultrazonica ?>)">×</button>
                    </span>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!--/span-->
    </div>
  </div>
  <div class="form-actions">
    <button id="material" name="material" class="btn btn-info" type="button" onclick="registroCarga()">
      <i class="icon-ok bigger-110"></i>Agregar Material
    </button>
    <button id="set" class="btn btn-info" type="button" onclick="ultrazonica.cancelar();return false">
          <i class="icon-ok bigger-110"></i>Cancelar
    </button>
  </div>
</div>

<div id="modal-table" class="modal hide fade" tabindex="-1">
    <div class="modal-header no-padding">
      <div class="table-header">
        Detalle ingreso
      </div>
    </div>
    <div class="modal-body no-padding">
      <input type="hidden" id="idc" value="">
      <div class="row-fluid">
        <table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
          <thead>
            <tr>
              <th>Estado</th>
              <th>Tipo</th>
              <th>Descripcion</th>
              <th>Cantidad</th>
            </tr>
          </thead>
          <tbody id="detalleIngMaterial">
            <script type="text/template" id="tmpl-detalle">
              <tr>
                <th class="check"><input name="form-field-checkbox" type="checkbox" id ="estado" style="opacity:1;" ></th>
                <th class="tipo"></th>
                <th class="descripcion"></th>
                <th class="cantidad"></th>
              </tr>
            </script>
          </tbody>
        </table>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-small pull-left" id="enviar" type="button" onclick="llenaCargaUl()">
        <i class="icon-ok bigger-110"></i>
        Guardar
      </button>
      <button class="btn btn-small btn-danger pull-left" data-dismiss="modal" onclick="ultrazonica.cancelar();return false">
        <i class="icon-remove"></i>
        Close
      </button>
    </div>
</div>

<script src="assets/js/jquery-2.0.3.min.js"></script>
<script src="js/ZR/ultrazonica.js"></script>
<script src="js/ZR/appUltra.js"></script>
<script>
  $(document).ready(function(){
    window.ultrazonica.init();
  });
</script>
