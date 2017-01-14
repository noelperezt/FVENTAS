<?php 
require '../../../cfg/base.php';
$dp = $mempresa->getAll();
$listaAnulados = $mventas->getVentaFactAnul();
?>
<html>
	<head>
		<meta charset="utf8">
		<title>Anulaciones Realizadas</title>
		<link rel="stylesheet" href="css/print.css">
	</head>
	<body>
		<center><img src="img/<?php echo $dp[0]->emprlogo ?>" alt="" style="width:95%"></center>
		<h1>Anulaciones Realizadas</h1>
		<!-- contenido -->
		
		<table class="table1">
			<thead>
				<tr>
					<th>Número</th>
					<th>Cliente</th>
					<th>Sub-Total</th>
					<th>Iva</th>
					<th>Total</th>
					<th>Fecha</th>
				</tr>
			</thead>
			<tbody>
				<?php if(count($listaAnulados)>0) { ?>
					<?php foreach($listaAnulados as $la) { ?>
						<tr>
							<td><?php echo $la->factide?></td>
							<td><?php echo $la->clierazsoc ?></td>
							<td><?php echo $la->factsubtot." Bs" ?></td>
							<td><?php echo $la->factiva." Bs" ?></td>
							<td><?php echo $la->facttotal." Bs" ?></td>
							<td><?php echo date("d/m/Y", strtotime($la->factfecha)) ?></td>
						</tr>
					<?php } ?>
				<?php } else { ?>
					<tr><td colspan="6">No hay Anulaciones Realizadas</td></tr>
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