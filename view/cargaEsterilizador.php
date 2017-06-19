<?php
  require_once 'model/tipoesterilizacion.php';
  $ctr=new tipoesterilizacion();
  $ls=$ctr->listartipos();
?>
<div class="breadcrumbs" id="breadcrumbs">
  <ul class="breadcrumb">
      <li>
          <a href="#">Zonal Azul </a>
          <span class="divider">
              <i class="icon-angle-right arrow-icon"></i>
          </span>
      </li>
      <li class="active">Carga Estirilizador</li>
  </ul><!--.breadcrumb-->
</div>
<div class="page-content">
  <form class="form-horizontal" >
    <div class="control-group">
      <label class="control-label" for="form-field-1">Tipo de estirilización: </label>
      <div class="controls">
        <select class="chosen-select" id="tipoeste" name="tipoeste" required="required" onchange="cargaportipo()">
          <option value="">Seleccione Tipo esterilización</option>
        <?php
          foreach ($ls as $em) {
        ?>
        <option value="<?php echo $em->codigo ?>"> <?php echo $em->nombre; ?></option>
        <?php
          }
        ?>
        </select>
      </div>
    </div>
  </form>
  <div class="table-responsive">
    <div class="table-header">
      Recepciones para carga
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
      <tbody id="carEste">
        <script type="text/template" id="tmpl-ingresos">
          <tr>
            <td class="id"></td>
            <td class="fecha"></td>
            <td class="propietario"></td>
            <td class="descripcion"></td>
            <td class="td-actions">
              <div class="action-buttons">
                <a href="javascript" title="Ver Detalle" onclick="ver(id)" role="button" class="green" data-toggle="modal">
                <!-- <a title="Ver Detalle" onclick="ver(id)" role="button" class="green" data-toggle="modal"> -->
                  <i class="icon-eye-open"></i>
                </a>
              </div>
            </td>
          </tr>
        </script>

      </tbody>
    </table>
  </div>
  <div class="hr hr32 hr-dotted"></div>
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-header">
          <h4 class="smaller">MATERIAL PARA CARGA ESTERILIZADOR</h4>
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
                  <th width="20px">Agregar</th>
                  <th width="10px"></th>
                </tr>
              </thead>
              <tbody id="carEster">
                <script type="text/template" id="tmpl-empaca">
                  <tr><td colspan="6"class="paquete"></td></tr>
                  <tr>
                    <!-- <th class="check"><input name="form-field-checkbox" type="checkbox" id ="estado" style="opacity:1;" ></th> -->
                    <td class="idCarga"></td>
                    <td class="tipoCarga"></td>
                    <td class="descripcionCarga"></td>
                    <td class="cantidadCarga"></td>
                    <!-- <th><input type="text" id="cantEmpacar" value="" disabled="true"  style="width: 20px;"></th> -->
                    <td>
                      <p color="green" id="empacado" nane="empacado" class="empacado" style="display:none">CARGADO!!!</p>
                      <button id="empacarBtn" name="empacarBtn" class="btn btn-info" type="button" onclick="">
                        Agregar
                      </button>
                    </td>
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
  </div>
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-header">
          <h4 class="smaller">CARGA ESTERILIZADOR</h4>
        </div>
        <div class="widget-body">
          <div class="widget-main">
            <table class="table table-striped table-bordered table-hover dataTable dt-responsive">
              <thead>
                <tr>
                  <th width="10px">Id</th>
                  <th width="10px">Servicio/Paciente</th>
                  <th width="10px">N° empaques</th>
                  <th width="15px">Tipo</th>
                  <th width="80px" >Descripción</th>
                  <th width="30px">Cantidad de piezas</th>
                  <th width="5px">Acción</th>
                </tr>
              </thead>
              <tbody id="cargaEste">
                <script type="text/template" id="tmpl-este">
                  <tr>
                    <!-- <th class="check"><input name="form-field-checkbox" type="checkbox" id ="estado" style="opacity:1;" ></th> -->
                    <td class="idCarga"></td>
                    <td class="descring"></td>
                    <td class="empaques"></td>
                    <td class="tipoCarga"></td>
                    <td class="descripcionCarga"></td>
                    <td class="piezas"></td>
                    <td class="td-actions">
                      <div class="action-buttons">
                        <a aling="center" class="red" id="" onclick="eliminaCarga(id);" role="button" title="Eliminar">
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
    </div>
    <div class="span4"></div>
    <div class="span4" >
      <select class="redondear" id="cmbMaquina" name="cmbMaquina" required="required" style="width:250px;"></select>
    </div>
    <div class="span4"></div>
  </div>
  <div class="form-actions">
    <button id="material" name="material" class="btn btn-info" type="button" onclick="registroCarga()">
      <i class="icon-ok bigger-110"></i>Agregar Carga Esterilizador
    </button>
    <button id="set" class="btn btn-danger" type="button" onclick="cancelar()">
      <i class="icon-ok bigger-110"></i>Cancelar
    </button>
  </div>
</div>

<?php require_once ("view/html/ZR/modDetalleSetKit.php") ?>
<?php require_once ("view/alerts.php") ?>

<div id="emp" class="modal hide fade" tabindex="-1">
  <form class="form-horizontal" onsubmit="return false;">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" >&times;</button>
      <h4 class="modal-title">Carga Estirilizador</h4>
    </div>
    <input type="hidden" id="iddetalle" name="iddetalle" value="">
    <div class="control-group">
      <label for="form-field-1" class="control-label">Falta cargar</label>
      <div class="controls">
        <input type="text" name="faltaempacar" id="faltaempacar" value="" readonly>
      </div>
    </div>
    <div class="control-group">
  		<label class="control-label" for="form-field-1">Cantidad a cargar</label>
  		<div class="controls">
        <input type="hidden" name="iddetalleMod" id="iddetalleMod" value="">
        <input type="hidden" name="cantEmp" id="cantEmp" value="">
        <input type="text" name="cantEmapacar" id="cantEmapacar" value="">
        <input type="hidden" name="position" id="position" value="">
  		</div>
  	</div>
    <div class="modal-footer">
      <button class="btn btn-small btn-info pull-left" id="enviar" type="button" onclick="agregaCarga()">
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
<script src="js/ZA/cargaesterilizacion.js"></script>
<script src="js/ZA/appCargaesterilizacion.js"></script>
<script>
  $(document).ready(function(){
    window.cargaesterilizador.init();
  });
</script>
