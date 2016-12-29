<?php
  require_once 'model/detalleIngMaterial.php';
  require_once 'model/ingresoMaterial.php';
  require_once 'model/lavadora.php';
  $ctr=new ingresoMaterial();
  $ctr2=new detalleIngMaterial();
  $ctr3=new lavadora();
  $ls=$ctr->listaRepcionesParaLavadora();
  $lsn=$ctr->listaRecepcionesEnProcesoLav();
  $d=$ctr->inicioLavadora();
  $lsl=$ctr3->retornaLavadoras();
  $lsocu=$ctr3->retornaLavadorasOcupadas();
?>
<div class="breadcrumbs" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <a href="#">Ingreso de material</a>
            <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
            </span>
        </li>
        <li class="active">Carga Lavadora</li>
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
        <tr>
          <th colspan="5">
            Recepciones Libres
          </th>
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
          <th colspan="5">
            Recepciones en proceso
          </th>
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
            <div class="controls">
              <label class="control-label" for="form-field-1">Seleccion un tipo: </label>
              <select class="redondear" id="lavadoraTipo" name="lavadoraTipo">
                <option value="LA"> Lavado </option>
                <option value="LS"> Lavado y secado </option>
              </select>
						</div>
          </div>
        </div>
      </div>
    </div><!--/span-->
    <div class="span6">
      <div class="widget-box">
        <div class="widget-header">
          <h4 class="smaller">Lavadoras</h4>
        </div>
        <div class="widget-body">
          <div class="widget-main">
            <div class="control-gropup">
              <label class="control-label" for="form-field-1">Lavadoras Disponibles: </label>
              <div class="controls">
                <select class="redondear" id="lavadora" name="lavadora">
                  <?php foreach ($lsl as $lav) { ?>
                    <option value="<?php echo $lav->id_lavadora ?>"> <?php echo $lav->nombre_lavadora; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="control-gropup">
              <label class="control-label" for="form-field-1">ultrazonicas Ocupadas: </label>
              <div class="controls">
                <div class="tags">
                  <?php foreach ($lsocu as $ocupa) { ?>
                    <span class="tag"><?php echo $ocupa->nombre_lavadora ?>
                      <button type="button" class="close" onclick="desocupaLavadora(<?php echo $ocupa->id_lavadora ?>)">×</button>
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
    <button id="set" class="btn btn-info" type="button" onclick="lavadora.cancelar();return false">
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
