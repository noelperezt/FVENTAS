<?php 
require '../../../cfg/base.php';
$listaMenu = $mentradas->getAll($prodide);
?>
<div class="entradas-insert"></div>
<table class="table table-bordered table-striped table-hover table-condensed">
	<thead>
		<tr>
			<th>Código</th>
			<th>Fecha</th>
			<th>Prov.</th>
			<th>Producto</th>
			<th>Cantidad/Unidad</th>
			<th>Opciones</th>
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
						<div class="btn-group">
							<button class="btn btn-danger btn-sm" onclick="borrarEntrada('entride=<?php echo $lm->entride ?>')"><i class="fa fa-trash-o"></i></button>
						</div>
					</td>
				</tr>
			<?php } ?>
		<?php } else { ?>
			<tr><td colspan="5">No hay entradas registradas</td></tr>
		<?php } ?>
	</tbody>
</table>

<script>
	load('app/entradas/vst/entradas.insert.php','prodide=<?php echo $prodide ?>','entradas-insert')
	function borrarEntrada(ide) {
		if(confirm('¿Realmente desea borrar la entrada seleccionada?')==true) {
			$.post('app/entradas/prc/_entradas.delete.php',ide);
			load('app/entradas/vst/entradas.lista.php','prodide=<?php echo $prodide ?>','entradas-lista');
			load('app/productos/vst/productos.lista.php','','productos-lista');
		}
	}
</script>