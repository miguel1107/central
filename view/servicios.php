<script src="js/servicio.js"></script>

  <?php
    require_once 'model/servicio.php';
    $ctr=new servicio();
    $ls=$ctr->listadoServicio();
  ?>

<div class="breadcrumbs" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <a href="#">Mantenimientos</a>
            <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
            </span>
        </li>
        <li class="active">Servicios</li>
    </ul><!--.breadcrumb-->
</div>
  <div class="page-content">
        <div class="row-fluid">
            <div class="span12">
            <!--      <div class="row-fluid"> -->
                <h2 class="header smaller lighter blue">Servicio</h2>
                <div class="span12">
                    <div class="span10">
                      <h5 class="text-success">Cantidad de registros <span class="badge"><?php echo count($ls); ?></span></h5>
                  </div>
                    <div class="span2">
                        <a id="nuevo_servicio" onclick="nuevo()"class="btn btn-app btn-mini btn-primary" data-toggle="modal" >Nuevo</a>
                    </div>
                </div>
                <br><br><br>
                <div class="table-responsive">
                    <div class="table-header">
                    Servicio registrados en el sistema.
                    </div>
                  <table id="listaservicios" class="table table-striped table-bordered table-hover dataTable dt-responsive"  cellspacing="0" width="100%">
                      <thead>
                          <tr>
                              <th>Id</th>
                              <th>Nombre</th>
                              <th>Accion</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php if (count($ls)): ?>
                          <?php foreach ($ls as $lservicio):
                                              $R=$listadoServicio?>
                          <tr>
                              <td><?php echo $lservicio->id_servicio; ?></td>
                              <td><?php echo $lservicio->nombre_servicio; ?></td>
                              <td class="td-actions">
                                  <div class="action-buttons">
                                      <a class="green" id="editar" onclick="editar(ser=<?php echo $lservicio->id_servicio; ?> )">
                                           <i class="icon-pencil bigger-130"></i>
                                      </a>
                                      <a class="red" id="eliminar" onclick="eliminar(ser=<?php echo $lservicio->id_servicio; ?> )">
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


<!-- show dialog-->
<div class="modal fade" id="servicioNuevo" role="dialog">
  <form id="test" class="form-horizontal" method="post" action="index.php?c=ctrServicio&a=insertar">
    <div class="modal-header">
          <h4 class="modal-title">Nuevo Usuario</h4>
    </div>
    <div class="control-group">
      <label class="control-label" for="form-field-1"> Nombre: </label>
      <div class="controls">
        <input type="txt" name="nomServi" id="nomServi" placeholder="Nombre de Servcio">
      </div>
    </div>
    <div class="form-actions">
      <input type="submit" class="btn btn-info" value="Guardar" id="btn-save">
      <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
    </div>
  </form>
</div>
<!---->
<div class="modal fade" id="modalModificar" role="dialog">
  <form id="modi" class="form-horizontal" method="post" action="index.php?c=ctrServicio&a=modificar">
    <div class="modal-header">
          <h4 class="modal-title">Modicar servicio</h4>
  </div>
  <div class="cotrol-group">
      <input type="hidden" name="idServiMod" id="idServiMod" >
      <label  class="control-label" for="form-field-1">Nombre: </label>
      <div class="controls">
        <input type="text" name="nomServiMod" id="nomServiMod" onkeypress="return soloLetras(event)">
      </div>
  </div>
  <div class="form-actions">
          <input type="submit" class="btn btn-info" value="Editar" id="btn-save">
          <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
        </div>
  </form>
</div>


<div class="modal fade" id="modalEliminar" role="dialog">
  <form id="eli" class="form-horizontal" method="post" action="index.php?c=ctrServicio&a=eliminar">
    <div class="modal-header">
          <h4 class="modal-title">Eliminar servicio</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" name="idServiEli" id="idServiEli" >
          <h5> ¿Desea eliminar este servicio? </5>
        </div>
        <div class="form-actions">
          <input type="submit" class="btn btn-info" value="Eliminar" id="btn-save">
          <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
        </div>
  </form>
</div>


<script >
  function soloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toUpperCase();
    letras = " ABCDEFGHIJKLMNÑOPQRSTUVWXYZ0123456789ºªºº/'.";
    especiales = "8-37-39-46";
    tecla_especial = false
    for (var i in especiales) {
      if (key == especiales[i]) {
        tecla_especial = true;
        break;
      }
    }
    if (letras.indexOf(tecla) == - 1 && !tecla_especial) {
      return false;
    }
  }
</script>
