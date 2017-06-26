<?php
  require_once 'model/esterilizador.php';
  $este= new esterilizador();
  $ls=$este->retornaEsterilizadoresConCarga();
?>
<div class="breadcrumbs" id="breadcrumbs">
  <ul class="breadcrumb">
    <li>
        <a href="#">Zona Verde</a>
        <span class="divider">
            <i class="icon-angle-right arrow-icon"></i>
        </span>
    </li>
    <li class="active">Descarga Estirilizador</li>
  </ul><!--.breadcrumb-->
</div>
<div class="page-content">
  <div class="table-responsive">
    <div class="table-header">
      ESTERILIZADORES CON CARGA
    </div>
    <table id="listaRecepciones" class="table table-striped table-bordered table-hover dataTable dt-responsive"  cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>Id</th>
          <th>Esterilizador</th>
          <th>Fecha Carga</th>
          <th>Accion</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($ls as $l) {
            $id=$l->id_esterilizador;
            $desc=$l->desc;
            $fecha=date_create($l->fecha);
        ?>
        <tr>
          <td><?php echo $id; ?></td>
          <td><?php echo $desc; ?></td>
          <td><?php echo date_format($fecha, 'd-m-Y (H:i:s)'); ?></td>
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
        ?>
      </tbody>
    </table>
  </div>
  <div class="hr hr32 hr-dotted"></div>
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
                  <th colspan="3"></th>
                  <th colspan="4">Detalle del paquete</th>
                </tr>
                <tr>
                  <th width="10px">Id</th>
                  <th width="10px">Servicio/Paciente</th>
                  <th width="10px">N° empaques</th>
                  <th width="15px">Tipo</th>
                  <th width="80px" >Descripción</th>
                  <th width="30px">Cantidad de piezas</th>
                  <th width="5px">Resset</th>
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
                        <a aling="center" class="green" id="" onclick="resset(id);" role="button" title="Reesterilizar">
                          <i class="icon-refresh bigger-130s"></i>
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
  <div class="form-actions">
    <button id="material" name="material" class="btn btn-info" type="button" onclick="#">
      <i class="icon-ok bigger-110"></i>Terminar Descarga
    </button>
    <button id="set" class="btn btn-danger" type="button" onclick="cancelar()">
      <i class="icon-ok bigger-110"></i>Cancelar
    </button>
  </div>
</div>
<?php require_once ("view/alerts.php") ?>
<?php require_once ("view/html/ZR/vercarga.php") ?>
<script src="assets/js/jquery-2.0.3.min.js"></script>
<script src="js/ZV/descargaEsterilizador.js"></script>
<script src="js/ZV/appDescargaEsterilizador.js"></script>

<script>
  $(document).ready(function(){
    window.descargaEsterilizador.init();
  });
</script>
