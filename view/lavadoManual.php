<?php
  require_once 'model/ingresoMaterial.php';
  $ctr=new ingresoMaterial();
  $ls=$ctr->listaRepcionesParaLavadora();
  $d=$ctr->inicioLavadora();
  $lsn=$ctr->listaRecepcionesEnProcesoLav();
?>
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
      <li class="active">Lavado Manual</li>
  </ul><!--.breadcrumb-->
</div>
<div class="page-content">
  <div class="table-responsive">
    <div class="table-header">
      Recepciones Disponibles
    </div>
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
      <tr>
        <th colspan="5">Recepciones Libres</th>
      </tr>
      <?php
      foreach ($ls as $lsr2){
        $id=$lsr2->id_ingreso;
        $pro=$lsr2->tipo_propietario;
        $ls2=$ctr->retornaRecpcionLavadora($id,$pro);
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
      <tr>
        <th colspan="5">Recepciones en proceso</th>
      </tr>
      <?php
      foreach ($lsn as $lsr2n){
        $idn=$lsr2n->id_ingreso;
        $pron=$lsr2n->tipo_propietario;
        $ls2n=$ctr->retornaRecpcionLavadoraProceso($idn,$pron);
        foreach ($ls2n as $lsr3n) {
      ?>
      <tr>
        <td><?php echo $idn; ?></td>
        <td><?php
          $fen=date_create($lsr3n->fecha);
          echo date_format($fen, 'd-m-Y (H:i:s)'); ?>
        </td>
        <td><?php
          $sn=$lsr3n->prop;
          if($sn=='S'){
            echo "Servicio";
          }elseif ($sn=='M') {
            echo "Médico";
          }elseif ($sn=='T') {
            echo "Terceros";
          }else {
            echo "Casa Comercial";
          }
          ?>
        </td>
        <td><?php echo $lsr3n->descripcion; ?></td>
        <td class="td-actions">
          <div class="action-buttons">
            <a href="javascript" onclick="ver(<?php echo $idn ?>)" role="button" class="green" data-toggle="modal">
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
  <div class="hr hr32 hr-dotted"></div>
  <div class="row-fluid">
    <div class="widget-header">
      <h4 class="smaller">Lavado Manual</h4>
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
          <tbody id="carLavadora">
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
      </div>
    </div>
  </div>
  <div class="form-actions">
    <button id="material" name="material" class="btn btn-info" type="button" onclick="registroLavManual()">
      <i class="icon-ok bigger-110"></i>Lavar
    </button>
    <button id="set" class="btn btn-danger" type="button" onclick="cancelar()">
      <i class="icon-ok bigger-110"></i>Cancelar
    </button>
  </div>
</div>
<?php require_once ("view/alerts.php") ?>

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
    <button class="btn btn-small pull-left" id="enviar" type="button" onclick="llenaCargaLav()">
      <i class="icon-ok bigger-110"></i>
      Guardar
    </button>
    <button class="btn btn-small btn-danger pull-left" data-dismiss="modal" onclick="lavadora.cancelar();return false">
      <i class="icon-remove"></i>
      Close
    </button>
  </div>
</div>

<script src="assets/js/jquery-2.0.3.min.js"></script>
<script src="js/ZR/lavadora.js"></script>
<script src="js/ZR/appLavadora.js"></script>
<script>
  $(document).ready(function(){
    window.lavadora.init();
  });
</script>
