
<?php
	$R=$_SESSION["nomusuario"];
	//$_SESSION['usuario']=$R;
	$d=$_SESSION["dniusuario"];
	//$_SESSION["dniusu"]=$d;
	$id=$_SESSION["idusuario"];
?>

<div class="navbar-inner">
	<input type="hidden" name="idusuario" value="<?php echo $id ?>">
	<div class="container-fluid">
		<a href="inicio.php" class="brand">
			<small>
				<i class="icon-leaf"></i>
					<?php
					echo "SISCE-HRL-".$zona;
					?>
			</small>
		</a><!--/.brand-->
		<ul class="nav ace-nav pull-right">
			<li class="purple">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="icon-bell-alt icon-animated-bell"></i>
								<span class="badge badge-important">8</span>
							</a>

							<ul class="pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-closer">
								<li class="nav-header">
									<i class="icon-warning-sign"></i>
									8 Notifications
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-mini no-hover btn-pink icon-comment"></i>
												New Comments
											</span>
											<span class="pull-right badge badge-info">+12</span>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										<i class="btn btn-mini btn-primary icon-user"></i>
										Bob just signed up as an editor ...
									</a>
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-mini no-hover btn-success icon-shopping-cart"></i>
												New Orders
											</span>
											<span class="pull-right badge badge-success">+8</span>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-mini no-hover btn-info icon-twitter"></i>
												Followers
											</span>
											<span class="pull-right badge badge-info">+11</span>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										See all notifications
										<i class="icon-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>
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
