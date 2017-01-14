  <?php require 'cfg/base.php'; $musuarios->redirecIndex(); $dp = $mempresa->getAll(); ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<title>FVENTAS</title>
  	<!-- Bootstrap -->
  	<link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  	<link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link href="css/principal.css" rel="stylesheet">
  <link rel="icon" type="image/png" href= "../img/icono.ico">
</head>
<body>

<div class="login-page">
	<div class="form">
		<form action="" class="login">
			<center><img src = "img/logofventas.png" width="100%"/></center>
			<br>
			<div class="container-fluid">
				<input type="text" name="usuario" placeholder="Usuario"/>
				<input type="password" name="clave" placeholder="Contraseña"/>
				<button>Iniciar Sesión</button>
			</div>
		</form>
	</div>
</div>
	



	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="js/jquery.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="lib/bootstrap/js/bootstrap.min.js"></script>
	<script src="lib/jquery-validation/dist/jquery.validate.min.js"></script>
	<script src="js/funciones.js"></script>
	<script>
		$(function(){
			var formulario = '.login'
			$(formulario).validate({
				rules: {
					usuario: {
						required: true,
					},
					clave: {
						required: true,
					},
				},
				 messages: {
					usuario: {
						required: 'Ingrese su usuario',
					},
					clave: {
						required: 'Indique la clave',
					},
				},
				submitHandler: function(form) {
					$.post('app/usuarios/prc/_login.php',$(formulario).serialize(),function(data){
						if(data==1) {
							location.href="index.php"
						} else {
							alerta('msj','danger',data)
						}
					})
				}
			});
		})
	</script>
</body>
</html>
