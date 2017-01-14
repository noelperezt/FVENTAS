<?php 
require '../../../cfg/base.php';
$dp = $mempresa->getAll();
$listaPersonal = $mclientes->getAll();
?>
<html>
	<head>
		<meta charset="utf8">
		<title>Lista de Clientes</title>
		<link rel="stylesheet" href="css/print.css">
	</head>
	<body>
		<center><img src="img/<?php echo $dp[0]->emprlogo ?>" alt="" style="width:95%"></center>
		<h1>Lista de Clientes</h1>
		<!-- contenido -->

		<table class="table1">
			<thead>
				<tr>
					<th>Cédula</th>
					<th>Razón Social</th>
					<th>Dirección</th>
					<th>Teléfono</th>
				</tr>
			</thead>
			<tbody>
				<?php if(count($listaPersonal)>0) { ?>
					<?php foreach($listaPersonal as $lp) { ?>
						<tr>
							<td><?php echo $lp->clienacion.$lp->cliecedula ?></td>
							<td><?php echo $lp->clierazsoc ?></td>
							<td><?php echo $lp->cliedirecc ?></td>
							<td><?php echo $lp->clietelefo ?></td>
						</tr>
					<?php } ?>
				<?php } else { ?>
					<tr><td colspan="4">No hay usuarios registrados</td></tr>
				<?php } ?>
			</tbody>
		</table>

		<!-- fin -->
		<div class="botones">
			<button type="button" onclick="window.close()">Cancelar</button>
			<button type="button" onclick="print()">Imprimir</button>
		</div>

	</body>
</html>