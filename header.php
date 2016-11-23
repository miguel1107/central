
<?php
	$R=$_SESSION["nomusuario"];
	//$_SESSION['usuario']=$R;
	$d=$_SESSION["dniusuario"];
	//$_SESSION["dniusu"]=$d;
	$id=$_SESSION["idusuario"];
?>

<div class="navbar-inner">
	<input type="hidden" name="idiusuario" value="<?php echo $id ?>">
	<div class="container-fluid">
		<a href="inicio.php" class="brand">
			<small>
				<i class="icon-leaf"></i>
					<?php
					echo "Trazabilidad-".$zona;
					?>
			</small>
		</a><!--/.brand-->
		<ul class="nav ace-nav pull-right">
			<li class="light-blue">
				<a data-toggle="dropdown" href="#" class="dropdown-toggle">
					<img class="nav-user-photo" src="assets/avatars/avatar2.png" alt="Foto de usuario" />
					<span class="user-info">
						<small>Bienvenido: </small>
							<?php
								echo $R;
							?>
					</span>
					<i class="icon-caret-down"></i>
				</a>
				<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">

					<li>
						<a href="?menu=configuracion">
							<i class="icon-cog"></i>
							Configuracion
						</a>
					</li>

						<!-- <li>
							<a href="#">
								<i class="icon-user"></i>
								Profile
							</a>
						</li> -->

					<li class="divider"></li>
					<li>
						<a href="salir.php">
							<i class="icon-off"></i>
								Salir
						</a>
					</li>
				</ul>
			</li>
		</ul><!--/.ace-nav-->
	</div><!--/.container-fluid-->
</div><!--/.navbar-inner-->
