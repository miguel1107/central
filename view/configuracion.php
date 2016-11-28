<?php
	require_once __DIR__.'/../model/usuario.php';
	$usu=$_SESSION["usuario"];
	$dni=$_SESSION["dniusuario"];
	$oUsuario=new usuario();
	$ls=$oUsuario->retornaUsuario($dni);
	if(count($ls)){
		foreach ($ls as $usus ){
			$d=$usus->dni;
			$e=$usus->estado;
			$z=$usus->zona;
		}
	}
	$no=$oUsuario->retornaNombre($dni);
?>

<div class="breadcrumbs" id="breadcrumbs">
   	<ul class="breadcrumb">
       	<li>
           	<a href="#">Usuario</a>
           	<span class="divider">
               	<i class="icon-angle-right arrow-icon"></i>
           	</span>
       	</li>
       	<li class="active">Cambio de contraseña</li>
   	</ul><!--.breadcrumb-->
</div>

<form class="form-horizontal" action="" name="contra">
      <div class="control-group">
        <label class="control-label" for="form-field-1">Nombre Usuario: </label>
        <div class="controls">
          <input type="text" name="nombusu" class="ui-autocomplete-input" value="<?php echo  $no ?>" >
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="form-field-1">Dni: </label>
        <div class="controls">
          <input  type="text"  id="form-input-readonly" name="dni" value="<?php echo  $dni ?>">
        </div>
      </div>

			<div class="control-group">
        <label class="control-label" for="form-field-1">Nueva contraseña: </label>
        <div class="controls">
          <input type="password" id="form-input-readonly" name="pass" id="pass">
        </div>
      </div>

			<div class="control-group">
				<label class="control-label" for="form-field-1">Repita contraseña: </label>
				<div class="controls">
					<input type="password" id="form-input-readonly" name="newpass" id="newpass">
				</div>
			</div>
      <div class="form-actions">
				<input type="button" id="config" class="btn btn-info" value="Guardar" >
				<button type="button" class="btn btn-info">Cancelar</button>
			</div>
		</form>
		<script src="assets/js/jquery-2.0.3.min.js"></script>
<script src="js/usuario.js"></script>
