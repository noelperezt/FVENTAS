<?php 
require '../../../cfg/base.php';
@$cliente = $mclientes->clienteIde($clieide);
if(count($cliente)>0) {
?>
<hr>
<table class="table table-bordered width-60 margin-auto">
	<tr>
		<th colspan="4" class="info">Datos del Cliente</th>
	</tr>
	<tr>
		<th>Cédula de Identidad:</th>
		<td><?php echo $cliente[0]->clienacion.$cliente[0]->cliecedula ?></td>
		<th>Razón Social:</th>
		<td><?php echo $cliente[0]->clierazsoc ?></td>
	</tr>
	<tr>
		<th>Dirección:</th>
		<td><?php echo $cliente[0]->cliedirecc ?></td>
		<th>Teléfono:</th>
		<td><?php echo $cliente[0]->clietelefo ?></td>
	</tr>
</table>
<div class="clearfix"></div>
<div class="space-10"></div>
<div class="articulos-insert"></div>
<div class="clearfix"></div>
<div class="space-10"></div>
<div class="articulos-lista"></div>
<script type="text/javascript">
	load('app/ventas/vst/articulos.insert.php','clieide=<?php echo $cliente[0]->clieide ?>','articulos-insert')
	load('app/ventas/vst/articulos.lista.php','clieide=<?php echo $cliente[0]->clieide ?>','articulos-lista');
</script>
<?php } else { ?>
	<div class="alert alert-danger">Selección no válida</div>
<?php } ?>
