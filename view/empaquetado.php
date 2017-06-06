<?php
require_once 'model/detalleIngMaterial.php';
require_once 'model/ingresoMaterial.php';
require_once 'model/secadora.php';
require_once 'model/tipoenvoltura.php';
$ctr=new ingresoMaterial();
$ctr2=new detalleIngMaterial();
$ctr3=new secadora();
$ctr4=new tipoenvoltura();
$env=$ctr4->listado();
$ls=$ctr->listaRecepcionesEmpaquetado();

?>
<div class="breadcrumbs" id="breadcrumbs">
  <ul class="breadcrumb">
    <li>
        <a href="#">Zona Azul</a>
        <span class="divider">
            <i class="icon-angle-right arrow-icon"></i>
        </span>
    </li>
    <li class="active">Empaquetado</li>
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
        if (count($ls)>0) {
        foreach ($ls as $lsr2){
          $id=$lsr2->id_ingreso;
          $pro=$lsr2->tipo_propietario;
          $ls2=$ctr->retornaRecpcionEmpaquetado($id,$pro);
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
              <a href="javascript" title="Ver Detalle" onclick="ver(<?php echo $id ?>)" role="button" class="green" data-toggle="modal">
                <i class="icon-eye-open"></i>
              </a>
            </div>
          </td>
        </tr>
        <?php
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
          <h4 class="smaller">MATERIAL PARA VPRO</h4>
        </div>
        <div class="widget-body">
          <div class="widget-main">
            <table class="table table-striped table-bordered table-hover dataTable dt-responsive">
              <thead>
                <tr>
                  <th width="10px">Id</th>
                  <th width="15px">Tipo</th>
                  <th width="80px" >Descripcion</th>
                  <th width="15px">Cantidad de piezas</th>
                  <th width="20px">Empacar</th>
                  <th width="10px"></th>
                </tr>
              </thead>
              <tbody id="carVpro">
                <script type="text/template" id="tmpl-empaca">
                  <tr><td colspan="6"class="paquete"></td></tr>
                  <tr>
                    <!-- <th class="check"><input name="form-field-checkbox" type="checkbox" id ="estado" style="opacity:1;" ></th> -->
                    <td class="idCarga"></td>
                    <td class="tipoCarga"></td>
                    <td class="descripcionCarga"></td>
                    <td class="cantidadCarga"></td>
                    <!-- <th><input type="text" id="cantEmpacar" value="" disabled="true"  style="width: 20px;"></th> -->
                    <td><button id="empacarBtn" name="empacarBtn" class="btn btn-info" type="button" onclick="">
                      Empacar
                    </button></td>
                    <td class="td-actions">
                      <div class="action-buttons">
                        <a class="green" id="ver" title="Ver Detalle" onclick="verMat(id)" role="button" >
                          <i class="icon-eye-open"></i>
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
    </div>
    <div class="span6">
      <div class="widget-box">
        <div class="widget-header">
          <h4 class="smaller">MATERIAL PARA AUTOCLAVE</h4>
        </div>
        <div class="widget-body">
          <div class="widget-main">
            <table class="table table-striped table-bordered table-hover dataTable dt-responsive">
              <thead>
                <tr>
                  <th width="10px">Id</th>
                  <th width="15px">Tipo</th>
                  <th width="80px">Descripcion</th>
                  <th width="15px">Cantidad de piezas</th>
                  <th width="20px">Empacar</th>
                  <th width="10px"></th>
                </tr>
              </thead>
              <tbody id="carAu">
              </tbody>
            </table>
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php require_once ("view/html/ZR/modDetalleSetKit.php") ?>

<div id="emp" class="modal hide fade" tabindex="-1">
  <form class="form-horizontal" onsubmit="return false;">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" >&times;</button>
      <h4 class="modal-title">Empaquetado</h4>
    </div>
    <input type="hidden" id="iddetalle" name="iddetalle" value="">
    <div class="control-group">
  		<label class="control-label" for="form-field-1">Tipo de envoltura</label>
  		<div class="controls">
        <select class="envoltura" name="envoltura" id="envoltura">
  			<?php
          foreach ($env as $e) {
        ?>
          <option value="<?php echo $e->id_tipo_envoltura ?>"> <?php echo $e->nombre_tipo_envoltura; ?></option>
        <?php
          }
        ?>
        </select>
  		</div>
  	</div>
    <div class="control-group">
  		<label class="control-label" for="form-field-1">Cantidad a empacar</label>
  		<div class="controls">
        <input type="hidden" name="idingreso" id="idingreso" value="">
        <input type="hidden" name="iddetalleMod" id="iddetalleMod" value="">
        <input type="hidden" name="cantEmp" id="cantEmp" value="">
        <input type="hidden" name="ti" id="ti" value="">
        <input type="text" name="cantEmapacar" id="cantEmapacar" value="">
  		</div>
  	</div>
    <div class="modal-footer">
      <button class="btn btn-small btn-info pull-left" id="enviar" type="button" onclick="registroEmpaque()">
        <i class="icon-ok bigger-110"></i>
        Empacar
      </button>
      <button class="btn btn-small btn-danger pull-left" data-dismiss="modal">
        <i class="icon-remove"></i>
        Cacelar
      </button>
    </div>

  </form>

</div>


<script src="assets/js/jquery-2.0.3.min.js"></script>
<script src="js/ZA/empaquetado.js"></script>
<script src="js/ZA/appEmpaquetado.js"></script>
<script>
  $(document).ready(function(){
    window.empaque.init();
  });
</script>
