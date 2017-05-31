<?php
require_once 'model/detalleIngMaterial.php';
require_once 'model/ingresoMaterial.php';
require_once 'model/secadora.php';
$ctr=new ingresoMaterial();
$ctr2=new detalleIngMaterial();
$ctr3=new secadora();
$ls=$ctr->listaRepcionesParaSec();
$lsn=$ctr->listaRecepcionesEnProcesoSec();
$d=$ctr->inicioSecadora();
$lsl=$ctr3->retornaSecadoras();
$lsocu=$ctr3->retornaSecadorasOcupadas();
?>
<div class="breadcrumbs" id="breadcrumbs">
  <ul class="breadcrumb">
      <li>
          <a href="#">Ingreso de material</a>
          <span class="divider">
              <i class="icon-angle-right arrow-icon"></i>
          </span>
      </li>
      <li class="active">Carga Secadora</li>
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
            Libres
          </th>
        </tr>
        <?php
        if (count($ls)>0) {
        foreach ($ls as $lsr2){
          $id=$lsr2->id_ingreso;
          $pro=$lsr2->tipo_propietario;
          $ls2=$ctr->retornaRecpcionSecadora($id,$pro);
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
      }
        ?>
        <tr>
          <th colspan="5">
            Recepciones en Proceso
          </th>
        </tr>
        <?php
        if(count($lsn)>0){
        foreach ($lsn as $lsr2n){
          $idn=$lsr2n->id_ingreso;
          $pron=$lsr2n->tipo_propietario;
          $lsm=$ctr->retornaRecpcionSecadoraProceso($idn,$pron);
          if (count($lsm)>0) {
          foreach ($lsm as $lsr3n) {
        ?>
        <tr>
          <td><?php echo $idn; ?></td>
          <td><?php
            $fen=date_create($lsr3n->fecha);
            echo date_format($fen, 'd-m-Y (H:i:s)'); ?>
          </td>
          <td><?php
            $sn=$lsr3->prop;
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
          <h4 class="smaller">Carga Secadora</h4>
        </div>
        <div class="widget-body">
          <div class="widget-main">
            <table class="table table-striped table-bordered table-hover dataTable dt-responsive">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Tipo</th>
                  <th>Descripcion</th>
                  <th>Cant. Piezas</th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="carSecadora">
                <script type="text/template" id="tmpl-carga">
                  <tr>
                    <td class="idCarga"></td>
                    <td class="tipoCarga"></td>
                    <td class="descripcionCarga"></td>
                    <td class="cantidadCarga"></td>
                    <td class="td-actions">
                      <div class="action-buttons">
                        <a class="red" id="" onclick="eliminaCarga(id);" role="button" title="Eliminar">
                          <i class="icon-trash bigger-130"></i>
                        </a>
                      </div>
                    </td>
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
          <h4 class="smaller">Secadoras</h4>
        </div>
        <div class="widget-body">
          <div class="widget-main">
            <div class="control-gropup">
              <label class="control-label" for="form-field-1">Secadoras Disponibles: </label>
              <div class="controls">
                <select class="redondear" id="secadora" name="secadora">
                  <option value="0">--Seleccione Secadora--</option>
                  <?php foreach ($lsl as $sec) { ?>
                    <option value="<?php echo $sec->id_secadora ?>"> <?php echo $sec->nombre_secadora; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="control-gropup">
              <label class="control-label" for="form-field-1">Secadoras Ocupadas: </label>
              <div class="controls">
                <div class="tags">
                  <?php foreach ($lsocu as $ocupa) { ?>
                    <span class="tag"><?php echo $ocupa->nombre_secadora ?>
                      <button title="desocupar secadora" type="button" class="close" onclick="desocupaSecadora(<?php echo $ocupa->id_secadora ?>)">×</button>
                    </span>
                    <a href="javascript" title="Ver carga" onclick="verCarga(<?php echo $ocupa->id_secadora ?>)" role="button" class="green" data-toggle="modal">
                      <i class="icon-eye-open"></i>
                    </a>
                  <?php } ?>
                </div>
              </div>
              <div class="form-actions">
                <button id="material" name="material" class="btn btn-info" type="button" onclick="registroCargaSec()">
                  <i class="icon-ok bigger-110"></i>Agregar Carga Secadora
                </button>
                <button id="set" class="btn btn-danger" type="button" onclick="cancelar()">
                  <i class="icon-ok bigger-110"></i>Cancelar
                </button>
              </div>
            </div>
          </div>
        </div>
      </div><!--/span-->
    </div>
  </div>

</div>
<?php require_once ("view/alerts.php") ?>
<?php require_once ("view/html/ZR/vercarga.php") ?>
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
            <th class="check" style="width:55px;">Estado
              <input name="form-field-checkbox" type="checkbox" id ="selecciongeneral" style="opacity:1;padding-lef:10px;" onclick="selecciongeneral()"></th>
            <th>Tipo</th>
            <th>Descripcion</th>
            <th>Cant. Piezas</th>
          </tr>
        </thead>
        <tbody id="detalleIngMaterialSec">
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
    <button class="btn btn-small pull-left" id="enviar" type="button" onclick="llenaCargaSec()">
      <i class="icon-ok bigger-110"></i>
      Guardar
    </button>
    <button class="btn btn-small btn-danger pull-left" data-dismiss="modal">
      <i class="icon-remove"></i>
      Close
    </button>
  </div>
</div>


<script src="assets/js/jquery-2.0.3.min.js"></script>
<script src="js/ZR/secadora.js"></script>
<script src="js/ZR/appSecadora.js"></script>
<script>
  $(document).ready(function(){
    window.secadora.init();
  });
</script>
