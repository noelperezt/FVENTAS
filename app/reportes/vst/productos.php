<?php 
require '../../../cfg/base.php';
$dp = $mempresa->getAll();
$listaProd = $mproductos->getAll();
?>
<html>
	<head>
		<meta charset="utf8">
		<title>Productos y Existencia</title>
		<link rel="stylesheet" href="css/print.css">
	</head>
	<body>
		<center><img src="img/<?php echo $dp[0]->emprlogo ?>" alt="" style="width:95%"></center>
		<h1>Productos y Existencia</h1>
		<!-- contenido -->
		
		<table class="table1">
			<thead>
				<tr>
					<th>Código</th>
					<th>Descripción</th>
					<th>Precio</th>
					<th>Existencia</th>
					<th>Stock Mínimo</th>
					<th>Unidad de Medida</th>
					<th>Observaciones</th>
				</tr>
			</thead>
			<tbody>
				<?php if(count($listaProd)>0) { ?>
					<?php foreach($listaProd as $lp) { ?>
						<tr <?php echo $cproductos->stockMinimo($lp->prodstomin,$mproductos->stock($lp->prodide)) ?>>
							<td><?php echo sprintf("%05d",$lp->prodide) ?></td>
							<td><?php echo $lp->proddescri ?></td>
							<td><?php echo $lp->prodprecio ?></td>
							<td><?php echo $mproductos->stock($lp->prodide) ?></td>
							<td><?php echo $lp->prodstomin ?></td>
							<td><?php echo $lp->unmedescri ?></td>
							<td>
								
							</td>
						</tr>
					<?php } ?>
				<?php } else { ?>
					<tr><td colspan="5">No hay productos registrados</td></tr>
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