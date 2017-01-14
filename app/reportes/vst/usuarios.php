<?php 
require '../../../cfg/base.php';
$dp = $mempresa->getAll();
$listaUsuarios = $musuarios->getAll();
?>
<html>
	<head>
		<meta charset="utf8">
		<title>Lista de Usuarios</title>
		<link rel="stylesheet" href="css/print.css">
	</head>
	<body>
		<center><img src="img/<?php echo $dp[0]->emprlogo ?>" alt="" style="width:95%"></center>
		<h1>Lista de Usuarios</h1>
		<!-- contenido -->

		<table class="table1">
			<thead>
				<tr>
					<th>Cédula</th>
					<th>Apellidos y Nombres</th>
					<th>Usuario</th>
					<th>Estatus</th>
					<th>Observaciones</th>
				</tr>
			</thead>
			<tbody>
				<?php if(count($listaUsuarios)>0) { ?>
					<?php foreach($listaUsuarios as $lu) { ?>
						<tr>
							<td><?php echo $lu->usuanacion.$lu->usuacedula ?></td>
							<td><?php echo $lu->usuaapelli.', '.$lu->usuanombre ?></td>
							<td><?php echo $lu->acceusuari ?></td>
							<td><?php echo $cusuarios->estadoUsuario($lu->accesestado) ?></td>
							<td>

							</td>
						</tr>
					<?php } ?>
				<?php } else { ?>
					<tr><td colspan="5">No hay usuarios registrados</td></tr>
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