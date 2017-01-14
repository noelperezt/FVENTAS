<?php 
require '../../../cfg/base.php';
$listaPersonal = $mclientes->getAll();
?>
<table class="table table-bordered table-striped table-hover table-condensed">
	<thead>
		<tr>
			<th>Cédula</th>
			<th>Razón Social</th>
			<th>Dirección</th>
			<th>Teléfono</th>
			<th>Opciones</th>
		</tr>
	</thead>
	<tbody>
		<?php if(count($listaPersonal)>0) { ?>
			<?php foreach($listaPersonal as $lp) { ?>
				<tr>
					<td><?php echo $lp->clienacion.$lp->cliecedula ?></td>
					<td><?php echo $lp->clierazsoc ?></td>
					<td><?php echo $lp->cliedirecc ?></td>
					<td><?php echo $lp->clietelefo ?></td>
					<td>
						<div class="btn-group">
							<button class="btn btn-warning btn-sm" onclick="modal('app/clientes/vst/clientes.update.php','clieide=<?php echo $lp->clieide ?>')"><i class="fa fa-edit"></i></button>
							<button class="btn btn-danger btn-sm" onclick="modal('app/clientes/vst/clientes.delete.php','clieide=<?php echo $lp->clieide ?>')"><i class="fa fa-trash-o"></i></button>						</div>
					</td>
				</tr>
			<?php } ?>
		<?php } else { ?>
			<tr><td colspan="5">No hay clientes registrados</td></tr>
		<?php } ?>
	</tbody>
</table>