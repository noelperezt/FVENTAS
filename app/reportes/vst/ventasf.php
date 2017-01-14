<?php 
require '../../../cfg/base.php';
$dp = $mempresa->getAll();
extract($_GET);
$fechai = $mesi."-".$diai."-".$anioi;
$fechaf = $mesf."-".$diaf."-".$aniof;
$listaVentas = $mventas->getVentaFactf($fechai,$fechaf);
$total = $mventas->getTotalFacts($fechai, $fechaf);
?>
<html>
	<head>
		<meta charset="utf8">
		<title>Ventas Realizadas </title>
		<link rel="stylesheet" href="css/print.css">
	</head>
	<body>
		<center><img src="img/<?php echo $dp[0]->emprlogo ?>" alt="" style="width:95%"></center>
		<h1>Ventas Realizadas desde el <?php echo $diai."/".$mesi."/".$anioi;?> hasta el <?php echo $diaf."/".$mesf."/".$aniof;?>  </h1>
		<!-- contenido -->
		
		<table class="table1">
			<thead>
				<tr>
					<th>N° Factura</th>
					<th>Cliente</th>
					<th>Sub-Total</th>
					<th>Iva</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				<?php if(count($listaVentas)>0) { ?>
					<?php foreach($listaVentas as $la) { ?>
						<tr>
							<td><?php echo $la->factide?></td>
							<td><?php echo $la->clierazsoc ?></td>
							<td><?php echo $la->factsubtot." Bs" ?></td>
							<td><?php echo $la->factiva." Bs" ?></td>
							<td><?php echo $la->facttotal." Bs" ?></td>
						</tr>
					<?php }
 ?>
					<tr class="danger">
							<th colspan="4" class="text-left">Total:</th>
							<td><?php if(count($total)>0) { ?>
							<?php foreach($total as $t) { 
							echo $t->total;}}?> Bs</td>
						</tr>
				<?php } else { ?>
					<tr><td colspan="6">No hay Ventas Realizadas</td></tr>
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