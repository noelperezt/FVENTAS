<?php 
require '../../../cfg/base.php';
$listaProd = $mproductos->getAll();
?>
<table class="table table-bordered table-striped table-hover table-condensed">
	<thead>
		<tr>
			<th>Código</th>
			<th>Descripción</th>
			<th>Precio</th>
			<th>Existencia</th>
			<th>Stock Mínimo</th>
			<th>Unidad de Medida</th>
			<th>Opciones</th>
		</tr>
	</thead>
	<tbody>
		<?php if(count($listaProd)>0) { ?>
			<?php foreach($listaProd as $lp) { ?>
				<tr <?php echo $cproductos->stockMinimo($lp->prodstomin,$mproductos->stock($lp->prodide)) ?>>
					<td><?php echo sprintf($lp->prodide) ?></td>
					<td><?php echo $lp->proddescri ?></td>
					<td><?php echo $lp->prodprecio ?></td>
					<td><?php echo $mproductos->stock($lp->prodide) ?></td>
					<td><?php echo $lp->prodstomin ?></td>
					<td><?php echo $lp->unmedescri ?></td>
					<td>
						<div class="btn-group">
							<button class="btn btn-warning btn-sm" onclick="modal('app/productos/vst/productos.update.php','prodide=<?php echo $lp->prodide ?>')"><i class="fa fa-edit"></i></button>
							<button class="btn btn-danger btn-sm" onclick="modal('app/productos/vst/productos.delete.php','prodide=<?php echo $lp->prodide ?>')"><i class="fa fa-trash-o"></i></button>
							<button class="btn btn-info btn-sm" onclick="modal('app/entradas/vst/admin.php','prodide=<?php echo $lp->prodide ?>')"><i class="fa fa-cloud-upload"></i></button>
							<button class="btn btn-success btn-sm" onclick="window.open('rpt-arribos-prodide=<?php echo $lp->prodide ?>')"><i class="fa fa-print"></i></button>
						</div>
					</td>
				</tr>
			<?php } ?>
		<?php } else { ?>
			<tr><td colspan="5">No hay productos registrados</td></tr>
		<?php } ?>
	</tbody>
</table>