<?php 
require '../../../cfg/base.php';
$ven1 = $mventas->getVentas($clieide);
?>
<?php if(count($ven1)>0) { ?>
	<table class="table table-hover table-striped width-80 margin-auto">
		<thead>
			<tr>
				<th>Borrar</th>
				<th>Fecha</th>
				<th>Descripción</th>
				<th>Precio</th>
				<th>Cantidad</th>
				<th>Total</th>		
			</tr>
		</thead>
		<tbody>
			<?php foreach($ven1 as $a) { ?>
				<tr>
					<td>
						<button class="btn btn-danger btn-sm" onclick="borrarArticulo('ventide=<?php echo $a->ventide ?>')">
							<i class="fa fa-trash-o"></i>
						</button>
					</td>
					<td><?php echo $a->ventfecha ?></td>
					<td><?php echo $a->proddescri ?></td>
					<td><?php echo $a->ventprecio ?></td>
					<td><?php echo $a->ventcantid ?></td>
					<td><?php echo $cventas->total($a) ?></td>
				</tr>
			<?php } ?>
			<tr class="danger">
				<th colspan="5" class="text-right">Total Bs.:</th>
				<td><?php echo $mventas->totalPagar($clieide,0) ?></td>
			</tr>
		</tbody>
	</table>
	<div class="space-10"></div>
	<div class="space-10"></div>
	<div class="form-actions clearfix col-sm-10 col-sm-offset-1">
		<button class="btn btn-primary pull-right" onclick="facturar('clieide=<?php echo $clieide ?>')">
			<i class="fa fa-check"></i> Facturar
		</button>
	</div>
<?php } ?>
<script>
	function borrarArticulo(ide) {
		if(confirm('¿Desea borrar el artículo seleccionado?')==true) {
			$.post('app/ventas/prc/_articulo.delete.php',ide,function(data){
				load('app/ventas/vst/articulos.insert.php','clieide=<?php echo $clieide ?>','articulos-insert')
				load('app/ventas/vst/articulos.lista.php','clieide=<?php echo $clieide ?>','articulos-lista');
			})
		}
	}
	function facturar(ide) {
		if(confirm('Al facturar, los productos desaparecerán de la lista actual. ¿Desea continuar?')==true) {
			$.post('app/ventas/prc/_facturar.php',ide,function(data){
				load('app/ventas/vst/articulos.insert.php','clieide=<?php echo $clieide ?>','articulos-insert')
				load('app/ventas/vst/articulos.lista.php','clieide=<?php echo $clieide ?>','articulos-lista');
				window.open('rpt-factura-factide='+data+'&clieide=<?php echo $clieide ?>');
			})
		}
	}
</script>