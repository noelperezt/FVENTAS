<?php 
require '../../../cfg/base.php';
$listaPersonal = $mproveedores->getAll();
?>
<table class="table table-bordered table-striped table-hover table-condensed">
	<thead>
		<tr>
			<th>RIF</th>
			<th>Razón Social</th>
			<th>Teléfono</th>
			<th>Correo</th>
			<th>Opciones</th>
		</tr>
	</thead>
	<tbody>
		<?php if(count($listaPersonal)>0) { ?>
			<?php foreach($listaPersonal as $lp) { ?>
				<tr>
					<td><?php echo $lp->provrif ?></td>
					<td><?php echo $lp->provrazsoc ?></td>
					<td><?php echo $lp->provtelefo ?></td>
					<td><?php echo $lp->provcorreo?></td>
					<td>
						<div class="btn-group">
							<button class="btn btn-warning btn-sm" onclick="modal('app/proveedores/vst/clientes.update.php','provide=<?php echo $lp->provide ?>')"><i class="fa fa-edit"></i></button>
							<button class="btn btn-danger btn-sm" onclick="modal('app/proveedores/vst/clientes.delete.php','provide=<?php echo $lp->provide ?>')"><i class="fa fa-trash-o"></i></button>
						</div>
					</td>
				</tr>
			<?php } ?>
		<?php } else { ?>
			<tr><td colspan="5">No hay proveedores registrados</td></tr>
		<?php } ?>
	</tbody>
</table>