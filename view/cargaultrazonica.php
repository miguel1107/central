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
                $ls2=$ctr2->retornaRecpcion($id,$pro);
                foreach ($ls2 as $lsr3) {
            ?>
            <tr>
              <td><?php echo $id; ?></td>
              <td><?php
                //$fe=
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
  </div>
</div>



<!--modal ver-->
  <div id="modal-table" class="modal hide fade" tabindex="-1">
    <div class="modal-header no-padding">
      <div class="table-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        Detalle ingreso
      </div>
    </div>
    <div class="modal-body no-padding">
      <input type="text" id="idc" value="">
      <div class="row-fluid">
        <table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
          <thead>
            <tr>
              <th>Codigo/Id</th>
              <th>Descripcion</th>
              <th>Cantidad</th>

            </tr>
          </thead>
          <?php

          ?>
          <tbody>
            <tr>
              
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-small btn-danger pull-left" data-dismiss="modal">
        <i class="icon-remove"></i>	Close
      </button>
    </div>
</div>

<script src="js/ZR/ultrazonica.js">

</script>
