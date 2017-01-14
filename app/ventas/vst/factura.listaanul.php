<?php 
require '../../../cfg/base.php';
$listaFacturas = $mventas->getVentaFactAnul();
$total = $mventas->getTotalFactAnul();
?><table class="table table-bordered table-striped table-hover table-condensed">
	<thead>
	<th style = "font-size: 20px;">
Total de Ventas Anuladas: <?php if(count($total)>0) { ?>
			<?php foreach($total as $t) { 
	echo $t->total;}}?> Bs. 
	</th>
	</thead>
</table>
<table class="table table-bordered table-striped table-hover table-condensed">
	<thead>
		<tr>
			<th>Número</th>
			<th>Cliente</th>
			<th>Sub-Total</th>
			<th>Iva</th>
			<th>Total</th>
			<th>Fecha</th>
			<th>Estado</th>
			<th>Opciones</th>
		</tr>
	</thead>
	<tbody>
		<?php if(count($listaFacturas)>0) { ?>
			<?php foreach($listaFacturas as $lf) { ?>
				<tr>
					<td><?php echo $lf->factide?></td>
					<td><?php echo $lf->clierazsoc ?></td>
					<td><?php echo $lf->factsubtot." Bs" ?></td>
					<td><?php echo $lf->factiva." Bs" ?></td>
					<td><?php echo $lf->facttotal." Bs" ?></td>
					<td><?php echo date("d/m/Y", strtotime($lf->factfecha)) ?></td>
					<td><?php if($lf->factestado == 0){
						echo "ANULADO";
					}else{
						echo "PROCESADO";
					}
					?></td>
					<td>
						<div class="btn-group">
							<button class="btn btn-success btn-sm" onclick="window.open('rpt-factura-factide=<?php echo $lf->factide ?>&clieide=<?php echo $lf->clieide ?>')"><i class="fa fa-print"></i></button>
						</div>
					</td>
				</tr>
			<?php } ?>
		<?php } else { ?>
			<tr><td colspan="8">No hay facturas anuladas</td></tr>
		<?php } ?>
	</tbody>
</table>