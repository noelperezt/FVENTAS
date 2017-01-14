<?php 
require '../../../cfg/base.php';
$dp = $mempresa->getAll();
extract($_GET);
$listaMenu = $mentradas->getAll($prodide);
?>
<html>
	<head>
		<meta charset="utf8">
		<title>Entrada de Mercancia</title>
		<link rel="stylesheet" href="css/print.css">
	</head>
	<body>
		<center><img src="img/<?php echo $dp[0]->emprlogo ?>" alt="" style="width:95%"></center>
		<h1>Entrada de Mercancia</h1>
		<!-- contenido -->

		<table class="table1">
			<thead>
				<tr>
					<th>Código</th>
					<th>Fecha</th>
					<th>Prov.</th>
					<th>Producto</th>
					<th>Cantidad/Unidad</th>
					<th>Observaciones</th>
				</tr>
			</thead>
			<tbody>
				<?php if(count($listaMenu)>0) { ?>
					<?php foreach($listaMenu as $lm) { ?>
						<tr>
							<td><?php echo sprintf("%05d",$lm->entride) ?></td>
							<td><?php echo $lm->entrfecha ?></td>
							<td><?php echo $lm->provrazsoc ?></td>
							<td><?php echo $lm->proddescri ?></td>
							<td><?php echo $lm->entrcantid ?> <?php echo $lm->unmedescri ?></td>
							<td>
								
							</td>
						</tr>
					<?php } ?>
				<?php } else { ?>
					<tr><td colspan="6">No hay entradas registradas</td></tr>
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