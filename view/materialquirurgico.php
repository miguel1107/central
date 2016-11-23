       <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="assets/font-awesome-4.3.0/css/font-awesome.css" />

        <!--[if IE 7]>
          <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
        <![endif]-->

        <!--page specific plugin styles-->

        <link rel="stylesheet" href="assets/css/jquery-ui-1.10.3.custom.min.css" />
        <link rel="stylesheet" href="assets/css/jquery.gritter.css" />

        <!--fonts-->

        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

        <!--ace styles-->
        <link rel="stylesheet" href="assets/css/ace.min.css" />
        <link rel="stylesheet" href="assets/css/ace-responsive.min.css" />
        <link rel="stylesheet" href="assets/css/ace-skins.min.css" />

<!--DATATABLES-->
<link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css" />
<link rel="stylesheet" href="assets/plugins/datatables/dataTables.responsive.css" />

<script src="assets/js/jquery-1.10.2.min.js"></script>
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>


        <!-- modal-->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  <?php
    require_once 'controller/crtMatQui.php';
    $ctr=new crtMatQui();
    //$ls=$ctr->listar();
  ?>

<div class="breadcrumbs" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <a href="#">Mantenimientos</a>
            <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
            </span>
        </li>
        <li class="active">Material Quirurgico</li>
    </ul><!--.breadcrumb-->
</div>
  <div class="page-content">
        <div class="row-fluid">
            <div class="span12">
            <!--      <div class="row-fluid"> -->
                <h2 class="header smaller lighter blue">Material Quirurgico</h2>
                <form action="#" method="POST">
                  <select id="selecTipo">
                    <option value='select'>--Seleccione tipo de material--</option>
                    <option value='GO'>Goma</option>
                    <option value='LA'>Latex</option>
                    <option value='ME'>Quirurgico</option>
                    <option value='PL'>Plastico</option>
                    <option value='PO'>Polietileno</option>
                    <option value='SI'>Slicona</option>
                    <option value='TX'>Textil</option>
                    <option value='VI'>Vidrio</option>
                  </select>
                  <input type="submit" name="tipoMAt" class="btn btn-app btn-mini btn-primary" value="mostrar">
                </form>


                <div class="span12">
                    <div class="span10">
                      <h5 class="text-success">Cantidad de registros <span class="badge"><?php echo count($ls); ?></span></h5>

                  </div>

                  <div class="span2">
                        <a class="btn btn-app btn-mini btn-primary" data-toggle="modal" data-target="#modalNuevo">Nuevo</a>
                    </div>
                </div>
                <br><br><br>
                <div class="table-responsive">
                    <div class="table-header">
                    Servicio registrados en el sistema.
                    </div>
                  <table id="listausuarios" class="table table-striped table-bordered table-hover dataTable dt-responsive"  cellspacing="0" width="100%">
                      <thead>
                          <tr>
                              <th>Codigo</th>
                              <th>Tipo</th>
                              <th>Nombre Material</th>
                              <th>Accion</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php if (count($ls)): ?>
                          <?php foreach ($ls as $lmat): ?>
                          <tr>
                              <td><?php echo $lmat->codigo_mat; ?></td>
                              <td><?php echo $lmat->cod_tipo; ?></td>
                              <td><?php echo $lmat->nombre_material; ?></td>
                              <td class="td-actions">
                                  <div class="action-buttons">
                                      <a class="green" href="index.php?page=usuario&accion=modificar id=<?php echo $usuario->usr_id; ?>">
                                           <i class="icon-pencil bigger-130"></i>
                                      </a>
                                      <a class="red" href="index.php?page=usuario&accion=eliminar&id=<?php echo $usuario->usr_id;  ?>">
                                          <i class="icon-trash bigger-130"></i>
                                      </a>
                                  </div>
                              </td>
                          </tr>
                                  <?php endforeach; ?>
                                  <?php else : ?>
                                  <?php echo '<div class="alert alert-warning">No se encontraron registros.</div>'; ?>
                                  <?php endif; ?>
                      </tbody>
          </table>
                </div>  <!-- table-responsive -->
            </div><!-- span12 -->
    </div><!-- row-f -->
</div>


<!-- show dialog
<div class="modal fade" id="modalNuevo" role="dialog">

  <form action="?crtUsuario&action=insertar" method="POST" id="test">
    <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nuevo Usuario</h4>
        </div>
        <div class="modal-body">
          Dni: <input type="txt" name="dni" id="dni" placeholder="Dni usuario"><br>
          Empleado: <input type="text" name="empleado" id="empleado" placeholder="Empleado"> <br>
          Zona:
          <select class="redondear" id="perfil" name="zona">
          <option value='Zona Roja'>Zona Roja</option>
          <option value='Zona Azul'>Zona Azul</option>
        <option value='Zona Verde'>Zona Verde</option>
