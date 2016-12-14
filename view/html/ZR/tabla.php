<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="/central/assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="/central/assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="/central/assets/css/font-awesome.min.css" />

		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

		<link rel="stylesheet" href="/central/assets/css/ace.min.css" />
		<link rel="stylesheet" href="/central/assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="/central/assets/css/ace-skins.min.css" />

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
  </head>
  <body>

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
                <th></th>
                <th>Codigo/Id</th>
                <th>Descripcion</th>
                <th>Cantidad</th>
              </tr>
            </thead>
            <?php
              require_once __DIR__.'/../../../model/detalleIngMaterial.php';
              $ctr=new detalleIngMaterial();
              $id=$_GET['id'];
              $ls=$ctr->retornaDetalle($id);
            ?>
            <tbody>

              <?php
                foreach ($ls as $ls2) { ?>
                    <tr>
                  <th><input name="form-field-checkbox" type="checkbox" style="opacity:1;"></th>
                  <th><?php echo $ls2->id_matset; ?></th>
                  <th><?php echo $ls2->tipo_ingreso ?></th>
                  <th><?php echo $ls2->cantidad_material ?></th>
                  </tr>
                <?php
                }
              ?>


            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-small btn-danger pull-left" data-dismiss="modal">
          <i class="icon-remove"></i>	Close
        </button>
      </div>


  <script src="/central/assets/js/jquery.min.js"></script>
  <!--<![endif]-->

  <!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

  <!--[if !IE]>-->

  <!--<script type="text/javascript">
    window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
  </script>-->
  <script src="/central/assets/js/jquery-2.0.3.min.js"></script>
  <script type="text/javascript">
    window.jQuery || document.write("<script src='/central/assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
  </script>
  <script type="text/javascript">
    if("ontouchend" in document) document.write("<script src='/central/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
  </script>
  <script src="/central/assets/js/bootstrap.min.js"></script>


  <!--script src="assets/js/jquery-ui-1.10.3.custom.min.js"></script-->
  <script src="/central/assets/js/jquery.ui.touch-punch.min.js"></script>
  <script src="/central/assets/js/jquery.slimscroll.min.js"></script>
  <script src="/central/assets/js/jquery.easy-pie-chart.min.js"></script>
  <script src="/central/assets/js/jquery.sparkline.min.js"></script>
  <script src="/central/assets/js/flot/jquery.flot.min.js"></script>
  <script src="/central/assets/js/flot/jquery.flot.pie.min.js"></script>
  <script src="/central/assets/js/flot/jquery.flot.resize.min.js"></script>

  <!--ace scripts-->

  <script src="/central/assets/js/ace-elements.min.js"></script>
  <script src="/central/assets/js/ace.min.js"></script>

  <!--inline scripts related to this page-->

  <script src="/central/assets/js/jquery.dataTables.js"></script>
  <script src="/central/assets/js/jquery.dataTables.bootstrap.js"></script>
  <script src="/central/assets/js/dataTables.responsive.js"></script>
  <script src="/central/assets/js/chosen.jquery.min.js"></script>
  <script src="/central/assets/js/jquery-ui.js"></script>

  <script src="/central/js/ZR/ultrazonica.js">

  </script>
  </body>
</html>
