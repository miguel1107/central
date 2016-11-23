<script src="js/usuario.js"></script>

	<?php
		require_once 'model/usuario.php';
		$ctr=new usuario();
		$ls=$ctr->listadousarios();
	?>

<div class="breadcrumbs" id="breadcrumbs">
   	<ul class="breadcrumb">
       	<li>
           	<a href="#">Mantenimientos</a>
           	<span class="divider">
               	<i class="icon-angle-right arrow-icon"></i>
           	</span>
       	</li>
       	<li class="active">Usuarios</li>
   	</ul><!--.breadcrumb-->
</div>
 	<div class="page-content">
        <div class="row-fluid">
            <div class="span12">
            <!--      <div class="row-fluid"> -->
                <h2 class="header smaller lighter blue">Usuarios</h2>
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
	                            <th>DNI</th>
	                            <th>Usuario</th>
	                            <th>Zona</th>
	                            <th>Estado</th>
	                            <th>Accion</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                        <?php if (count($ls)): ?>
	                        <?php foreach ($ls as $lusuario): ?>
	                        <tr>
                            <td><?php echo $lusuario->id; ?></td>
	                           	<td><?php echo $lusuario->dni; ?></td>
	                            <td>
	                               	<?php
	                               		$nom=$ctr->retornaNombre($lusuario->dni);
	                               		echo $nom;
	                               	?>
	                            </td>
	                            <td>
	                              	<?php
		                               	$id=$lusuario->zona;
	                               		$zo=$ctr->retornaZona($id);
	                               		echo $zo;
	                               	?>
	                            </td>
	                            <td> <?php echo (($lusuario->estado) == 'A') ? "Activo" : "Inactivo" ; ?></td>
	                            <td class="td-actions">
	                                <div class="action-buttons">
	                                    <a class="green" id="editar" onclick="editar(<?php echo $lusuario->id; ?>)">
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
               	</div>  <!-- table-responsive -->
            </div><!-- span12 -->
    </div><!-- row-f -->
</div>


<!-- show dialog-->
<!--<div class="modal fade" id="modalNuevo" role="dialog">-->
<div id="modalNuevo" class="modal fade" role="dialog">
	<form id="test" class="form-horizontal" method="post" action="index.php?c=ctrUsuario&a=insertar">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Nuevo Usuario</h4>
    </div><br>
    <div class="control-group">
      <label class="control-label" for="form-field-1">Nombre Usuario: </label>
      <div class="controls">
        <input type="text" id="nomusuario" name="nombreusuario" placeholder="Empleado">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="form-field-1">Dni: </label>
      <div class="controls">
        <input type="text" id="dni" name="dni" placeholder="dni-empleado">
      </div>
    </div>
    <div class="control-gropup">
      <label class="control-label" for="form-field-1">zona: </label>
      <div class="controls">
        <select class="redondear" id="zona" name="zona">
         <option value='2'>Zona Roja</option>
         <option value='3'>Zona Azul</option>
         <option value='4'>Zona Verde</option>
        </select>
      </div>
    </div>

      <div class="form-actions">
        <input type="submit" class="btn btn-info" value="Guardar" id="btn-save">
        <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
      </div>
	</form>
</div>

<div id="modalModificar" class="modal fade" role="dialog">
	<form id="modi" class="form-horizontal" method="post" action="index.php?c=ctrUsuario&a=editar">
    <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Modificar Usuario</h4>
    </div><br>

		<div class="control-group">
				<input type="hidden" id="id" name="id">
		</div>
    <div class="control-group">
      <label class="control-label" for="form-field-1"> Zona: </label>
      <div class="controls">
        <select class="redondear" id="zona" name="zona">
         <option value='2'>Zona Roja</option>
         <option value='3'>Zona Azul</option>
         <option value='4'>Zona Verde</option>
        </select>
      </div>
    </div>
		<div class="control-group">
      <label class="control-label" for="form-field-1"> Estado: </label>
      <div class="controls">
        <select class="redondear" id="estado" name="estado">
         <option value='A'>Activo</option>
         <option value='I'>Inactivo</option>
       </select>
      </div>
    </div>

    <div class="form-actions">
      <input type="submit" class="btn btn-info" value="Guardar" id="btn-save">
      <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
    </div>
	</form>
</div>

<div id="modalEliminar" class="modal fade" role="dialog">
	<form id="elim" class="form-horizontal" method="post" action="index.php?c=ctrUsuario&a=eliminar">
		<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal">&times;</button>
         	<h4 class="modal-title">Eliminar Usuario</h4>
    </div>
        <div class="modal-body">
          <input type="hidden" id="idUs" name="idUs">
          <h5>¿Desea elminar este usuario?</h5>
          <div class="form-actions">
            <input type="submit" class="btn btn-info" value="Eliminar" id="btn-save">
            <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
          </div>
	</form>
</div>
