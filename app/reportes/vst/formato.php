<?php 
require '../../../cfg/base.php';
$dp = $mempresa->getAll();
?>
<html>
	<head>
		<meta charset="utf8">
		<title></title>
		<link rel="stylesheet" href="css/print.css">
	</head>
	<body>
		<center><img src="img/<?php echo $dp[0]->emprlogo ?>" alt="" style="width:95%"></center>
		<h1></h1>
		<!-- contenido -->


		<!-- fin -->
		<div class="botones">
			<button type="button" onclick="window.close()">Cancelar</button>
			<button type="button" onclick="print()">Imprimir</button>
		</div>

	</body>
</html>