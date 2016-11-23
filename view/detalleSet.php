<?php
require_once __DIR__.'/../model/detalleset.php';

 $idSet=$_SESSION["idSet"];
 $ctr=new detalleset();
 $id=3;
 $ls=$ctr->listadoDetalleset($id);
?>
<div class="row-fluid">
    <div class="span12">
    <!--      <div class="row-fluid"> -->
        <h2 class="header smaller lighter blue">Detalle Set</h2>
          <div class="span12">
            <div class="span10">
              <h5 class="text-success">Cantidad de registros <span class="badge"><?php echo count($ls); ?></span></h5>
          </div>
            <div class="span2">
                <!--<a class="btn btn-app btn-mini btn-primary" id ="nuevo_usuario" data-toggle="modal" data-target="#modalNuevo">Nuevo</a>-->
                <a id ="nuevo_usuario" class="btn btn-app btn-mini btn-primary" href="#">Nuevo</a>
            </div>
        </div>
        <br><br><br>
        <div class="table-responsive">
            <div class="table-header">
            Usuarios registrados en el sistema.
            </div>
            <table id="listausuarios" class="table table-striped table-bordered table-hover dataTable dt-responsive"  cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th>Id</th>
                      <th>Nombre material</th>
                      <th>Cantidad de piezas</th>
                      <th>Accion</th>
                  </tr>
              </thead>
              <tbody>
                  <?php if (count($ls)): ?>
                  <?php foreach ($ls as $ldetalle): ?>
                  <tr>
                    <td><?php echo $ldetalle->id_detalle; ?></td>
                      <td><?php echo $ldetalle->nombre_mat; ?></td>
                      <td><?php echo $ldetalle->piezas_material; ?></td>
                      <td class="td-actions">
                          <div class="action-buttons">
                              <a class="green" id="editar" onclick="editar(id=<?php echo $lusuario->id; ?>)">
                                   <i class="icon-pencil bigger-130"></i>
                              </a>
                              <a class="red" id="eliminar" onclick="eliminar(<?php echo $lusuario->id; ?>)">
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
        </div>
        <div class="modal-footer">
          <button class="btn btn-small btn-danger pull-left" data-dismiss="modal">
      <i class="icon-remove"></i>
                          Close
                        </button>

                        <div class="pagination pull-right no-margin">
                          <ul>
                            <li class="prev disabled">
                              <a href="#">
                                <i class="icon-double-angle-left"></i>
                              </a>
                            </li>

                            <li class="active">
                              <a href="#">1</a>
                            </li>

                            <li>
                              <a href="#">2</a>
                            </li>

                            <li>
                              <a href="#">3</a>
                            </li>

                            <li class="next">
                              <a href="#">
                                <i class="icon-double-angle-right"></i>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div>  <!-- table-responsive -->
    </div><!-- span12 -->
</div><!-- row-f -->
</div>
