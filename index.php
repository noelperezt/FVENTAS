<?php require 'cfg/base.php'; $musuarios->redirecLogin(); $dp = $mempresa->getAll(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>FVENTAS</title>
	  <!-- ... -->
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="lib/datepicker/js/bootstrap-datepicker.js"></script>
  <link rel="stylesheet" href="lib/datepicker/css/datepicker.css" />
	<!-- Bootstrap -->
	<link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="lib/chosen/chosen.css" rel="stylesheet">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<link href="css/principal.css" rel="stylesheet">
<link rel="icon" type="image/png" href= "../img/icono.ico">
<script src="lib/bootstrap/js/bootstrap.min.js"></script>
<script src="lib/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="lib/chosen/chosen.jquery.js"></script>
<script src="js/funciones.js"></script>
</head>
<body>
	<div class="modal fade">
	  <div class="modal-dialog">
	    <div class="modal-content">
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->


	<div class="col-sm-10 col-sm-offset-1">
		<div class="logo">
			<img src="img/<?php echo $dp[0]->emprlogo ?>" alt="" class="logo">
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="col-sm-10  col-sm-offset-1">
		<div class="col-sm-2 menu"><?php require 'menu.php'; ?></div>
		<div class="col-sm-10">
			<div class="contenido">
				<?php require 'contenido.php'; ?><div class="clearfix"></div><div class="space-20"></div>
			</div>
			
		</div>
	</div>
</body>
</html>
