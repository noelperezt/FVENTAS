<?php 
require '../../../cfg/base.php';
$listaUsuarios = $musuarios->getAll();
?>
<table class="table table-bordered table-striped table-hover table-condensed">
	<thead>
		<tr>
			<th>Cédula</th>
			<th>Apellidos y Nombres</th>
			<th>Usuario</th>
			<th>Estatus</th>
			<th>Opciones</th>
		</tr>
	</thead>
	<tbody>
		<?php if(count($listaUsuarios)>0) { ?>
			<?php foreach($listaUsuarios as $lu) { ?>
				<tr>
					<td><?php echo $lu->usuanacion.$lu->usuacedula ?></td>
					<td><?php echo $lu->usuaapelli.', '.$lu->usuanombre ?></td>
					<td><?php echo $lu->acceusuari ?></td>
					<td><?php echo $cusuarios->estadoUsuario($lu->accesestado) ?></td>
					<td>
						<div class="btn-group">
							<button class="btn btn-warning btn-sm" onclick="modal('app/usuarios/vst/usuarios.update.php','usuaide=<?php echo $lu->usuaide ?>')"><i class="fa fa-edit"></i></button>
							<button class="btn btn-danger btn-sm" onclick="modal('app/usuarios/vst/usuarios.delete.php','usuaide=<?php echo $lu->usuaide ?>')"><i class="fa fa-trash-o"></i></button>
							<button class="btn btn-success btn-sm" onclick="modal('app/usuarios/vst/usuarios.permisos.php','usuaide=<?php echo $lu->usuaide ?>')"><i class="fa fa-key"></i></button>
						</div>
					</td>
				</tr>
			<?php } ?>
		<?php } else { ?>
			<tr><td colspan="5">No hay usuarios registrados</td></tr>
		<?php } ?>
	</tbody>
</table>