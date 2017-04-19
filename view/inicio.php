
<?php
$navegacion=$_SESSION['navegacion'];
$zona=$_SESSION['zona'];
?>

<div class="breadcrumbs" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="icon-home home-icon"></i>
            <a href="#">Inicio</a>
            <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
            </span>
        </li>
        <li class="active"><?php echo $zona ?></li>
    </ul><!--.breadcrumb-->
 </div>
 <div class="page-content">
  <div class="page-header position-relative">
		<h1>
			SISCE-HRL
			<small>
				<i class="icon-double-angle-right"></i>
				Sistema de Central de Estirilización-Hospital Regional Lambayeque
			</small>
		</h1>
	</div>
  <div class="alert alert-info">
		<button type="button" class="close" data-dismiss="alert">
			<i class="icon-remove"></i>
		</button>
    <i class="icon-ok green"></i>
		<strong>Bienvenidos al SISCE-HRL (V1.0);</strong>
    para cualquier información favor de comunicarse con el administrador del sistema anexo
    <strong class="green">1208</strong>
		<br>
	</div>
  <div class="col-lg-12 center">
    <div class="col-md-3">
      <img src="img/logoditi.jpg" id="img_logo"  aling="center">
    </div>
    <div class="col-md-9">
      <h2 class="text-info">Bienvenido al Sistema Central de Esterilización</h2>
      <h4 class="text-info">Hospital Regional Lambayeque</h4>
      <br><br>
    </div>
  </div>

 </div>
