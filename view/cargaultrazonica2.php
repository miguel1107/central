<?php
  require_once 'model/detalleIngMaterial.php';
  require_once 'model/ingresoMaterial.php';
  $ctr=new ingresoMaterial();
  $ctr2=new detalleIngMaterial();
  $ls=$ctr->listaRecepcionesDisponibles();
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
                echo date_format($fe, 'd-m-Y (H:i:s)'); ?></td>
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

              ?></td>
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
                 <p>
                   <span class="btn btn-small" data-rel="tooltip" title="" data-original-title="Default">Default</span>
                   <span class="btn btn-warning btn-small tooltip-warning" data-rel="tooltip" data-placement="left" title="" data-original-title="Left Warning">Left</span>
                   <span class="btn btn-success btn-small tooltip-success" data-rel="tooltip" data-placement="right" title="" data-original-title="Right Success">Right</span>
                   <span class="btn btn-danger btn-small tooltip-error" data-rel="tooltip" data-placement="top" title="" data-original-title="Top Danger">Top</span>
                   <span class="btn btn-info btn-small tooltip-info" data-rel="tooltip" data-placement="bottom" title="" data-original-title="Bottm Info">Bottom</span>
                 </p>
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
												<p>
													<span class="btn btn-small" data-rel="popover" title="" data-content="Heads up! This alert needs your attention, but it's not super important." data-original-title="Default">Default</span>
													<span class="btn btn-success btn-small tooltip-success" data-rel="popover" data-placement="right" title="" data-content="Well done! You successfully read this important alert message." data-original-title="<i class='icon-ok green'></i> Right Success">Right</span>
													<span class="btn btn-warning btn-small tooltip-warning" data-rel="popover" data-placement="left" title="" data-content="Warning! Best check yo self, you're not looking too good." data-original-title="<i class='icon-warning-sign orange'></i> Left Warning">Left</span>
												</p>

												<p>
													<span class="btn btn-danger btn-small tooltip-error" data-rel="popover" data-placement="top" data-original-title="<i class='icon-bolt red'></i> Top Danger" data-content="Oh snap! Change a few things up and try submitting again.">Top</span>
													<span class="btn btn-info btn-small tooltip-info" data-rel="popover" data-placement="bottom" title="" data-content=" Heads up! This alert needs your attention, but it's not super important." data-original-title="Some Info">Bottom</span>
													<span class="btn btn-inverse btn-small popover-notitle" data-rel="popover" data-placement="bottom" data-content="Popover without a title!" data-original-title="" title="">No Title</span>
												</p>
											</div>
										</div>
									</div>
								</div><!--/span-->
							</div>
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
      <button class="btn btn-small pull-left" onclick="ultrazonica.llenaCarga();return false">
        <i class="icon-ok bigger-110"></i>
        Guardar
      </button>
      <button class="btn btn-small btn-danger pull-left" data-dismiss="modal" onclick="ultrazonica.restart();return false">
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
