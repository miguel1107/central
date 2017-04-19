<?php
$zona=$_SESSION["zona"];
?>
<a class="menu-toggler display" id="menu-toggler" href="#">
	<span class="menu-text"></span>
</a>
<div class="sidebar" id="sidebar">
	<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-small btn-success">
							<i class="icon-signal"></i>
						</button>

						<button class="btn btn-small btn-info">
							<i class="icon-pencil"></i>
						</button>

						<button class="btn btn-small btn-warning">
							<i class="icon-group"></i>
						</button>

						<button class="btn btn-small btn-danger">
							<i class="icon-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div>
	<ul class="nav nav-list">
<?php
switch ($zona) {
	case 'Administrador':
?>
		<li>
			<a href='#' class='dropdown-toggle'>
				<i class="icon-wrench"></i>
				<span class='menu-text'> Manteminetos</span>
				<b class="arrow icon-angle-down"></b>
			</a>
			<ul class='submenu'>
				<li>
					<a href='?menu=usuarios'>
						<i class='icon-plus'></i>
						Usuarios
					</a>
				</li>
				<li>
					<a href='?menu=servicios'>
						<i class='icon-plus'></i>
						Servicios
					</a>
				</li>
				<li>
					<a href='?menu=materialquirurgico'>
						<i class='icon-plus'></i>
						Material Quirurgico
					</a>
				</li>
				<li>
					<a href='?menu=set'>
						<i class='icon-plus'></i>
						Set de Material
					</a>
				</li>
			</ul>
		</li>
		<li>
			<a href='#' class='dropdown-toggle'>
				<span class='menu-text'> Reportes </span>
				<b class="arrow icon-angle-down"></b>
			</a>
		</li>
<?php
		break;
	case 'Zona Roja':
	?>
		<li>
			<a href='#' class='dropdown-toggle'>
				<i class="icon-edit"></i>
			 	<span class='menu-text'>Recepcion material</span>
				<b class="arrow icon-angle-down"></b>
		 	</a>
	 		<ul class='submenu'>
	 			<li>
	 				<a href="?menu=servicioZR">
						<i class='icon-plus'></i>
						por Servicio
					</a>
				</li>
	 			<li>
	 				<a href="?menu=medicoZR">
						<i class='icon-plus'></i>
						por Medico
					</a>
				</li>
	 			<li>
	 				<a href='?menu=tercerosZR'>
						<i class='icon-plus'></i>
						 por Terceros
					</a>
				</li>
	 			<li>
	 				<a href='?menu=casacomercialZR'>
						<i class='icon-plus'></i>
						Casa Comercial
					</a>
				</li>
	 		</ul>
 		</li>
		<li>
			<a href='?menu=cargaultrazonica2' class="dropdown-togle">
				<i class="icon-archive" aria-hidden="true"></i>
			 	<span class='menu-text'> Carga Ultrazonica </span>
			</a>
		</li>
		<li>
			<a href='?menu=cargaLavadora'>
				<i class="icon-cloud-upload"></i>
				<span class='menu-text'> Carga Lavadora </span>
			</a>
		</li>
		<li>
			<a href='?menu=lavadoManual'>
				<i class="icon-hand-paper icon-animated-hand-pointer"></i>
				<span class='menu-text'> Lavado Manual </span>
			</a>
		</li>
		<li>
			<a href='?menu=cargaSecadora'>
				<i class="icon-cloud-upload"></i>
				<span class='menu-text'> Carga Secadora </span>
			</a>
		</li>
		<li>
			<a href='?menu=secadoManual'>
				<i class="icon-hand-right icon-animated-hand-pointer"></i>
				<span class='menu-text'> Secado Manual </span>
			</a>
		</li>
<?php
		break;
	case 'Zona Azul':
?>
		<li>
			<a href='?menu=ingresoRopa'>
				<span class='menu-text'> Ingreso de ropa </span>
			</a>
		</li>
		<li>
			<a href='typography.html'>
				<span class='menu-text'> Empaquetado de ropa </span>
			</a>
		</li>
		<li>
			<a href='?menu=empaquetado'>
				<span class='menu-text'> Empaquetado </span>
			</a>
		</li>
<?php
				break;

			default:

				break;
		}

		?>
		</ul>
		<div class="sidebar-collapse" id="sidebar-collapse">
						<i class="icon-double-angle-left"></i>
				</div>
	</div>
