<?php
	$msj="marlon";
	if(isset($_GET['msj'])){
		$msje=$_GET['msj'];
	}
?>

	<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Sistema de Trazabilidad</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />

		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

		<link rel="stylesheet" href="assets/css/ace.min.css" />
		<link rel="stylesheet" href="assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

	<body class="login-layout">
		<div class="main-container container-fluid">
			<div class="main-content">
				<div class="row-fluid">
					<div class="span12">
						<div class="login-container">
							<div class="row-fluid">
								<div class="center">
									<h1>
										<i class="icon-leaf green"></i>
										<span class="red">SISCE-HRL</span>
									</h1>
									<h1>
										<span class="white">Application</span>
									</h1>
									<h4 class="blue">DIVISIÓN DE TECNOLOGÍAS DE LA INFORMACIÓN</h4>
									<h5 class="blue">&copy; Unidad de Desarrollo de Sistemas</h5>
								</div>
							</div>

							<div class="space-6"></div>

							<div class="row-fluid">
								<div class="position-relative">
									<div id="login-box" class="login-box visible widget-box no-border">
										<div class="widget-body">
											<div class="widget-main">
												<h4 class="header blue lighter bigger">
													<i class="icon-coffee green"></i>
													Digite su informacion!!
												</h4>

												<div class="space-6"></div>

												<form  name="frmlogin" method="POST" action="validar.php">
													<fieldset>
														<label>
															<span class="block input-icon input-icon-right">
																<input type="text" class="span12" placeholder="Username" name="usuario"/>
																<i class="icon-user"></i>
															</span>
														</label>

														<label>
															<span class="block input-icon input-icon-right">
																<input type="password" class="span12" placeholder="Password" name="pass"/>
																<i class="icon-lock"></i>
															</span>
														</label>

														<div class="space"></div>
														<!-- zonas-->
														<select class="redondear" id="perfil" name="zona">
										                	<option value='Zona Roja'>Zona Roja</option>
										                	<option value='Zona Azul'>Zona Azul</option>
										                	<option value='Zona Verde'>Zona Verde</option>
										                	<option value='Administrador'>Administrador</option>
										            	</select>
										            	<!--fin zonas-->
														<div class="space-4"></div>
														<button class="width-35 pull-right btn btn-small btn-primary">
																<i class="icon-key"></i>
																Login
														</button>
													</fieldset>
												</form>
												<!--
												<div class="social-or-login center">
													<span class="bigger-110">Or Login Using</span>
												</div>

												<div class="social-login center">
													<a class="btn btn-primary">
														<i class="icon-facebook"></i>
													</a>

													<a class="btn btn-info">
														<i class="icon-twitter"></i>
													</a>

													<a class="btn btn-danger">
														<i class="icon-google-plus"></i>
													</a>
												</div>
											</div><!--/widget-main-->
										</div><!--/widget-body-->
									</div><!--/login-box-->


		<script type="text/javascript">
			var msj = "<?= isset($msje) ? $msje : '' ?>"
			if(msj){
				alert(msj);
				cosole.log(msj);
			}
		</script>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

		<!--<![endif]-->

		<!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

		<!--[if !IE]>-->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>


	</body>
</html>
