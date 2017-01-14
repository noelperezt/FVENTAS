<?php 
require '../../../cfg/base.php';
$lista = $musuarios->opcionesMenuUsuaide($usuaide);
?>
<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th>Módulo</th>
			<th>Submódulo</th>
			<th>Estatus</th>
			<th>Opción</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($lista as $l) { ?>
			<?php 
				$perms = $musuarios->permisosUsuario($l->sumoide,$usuaide); 
				$perm = (count($perms)>0) ? $perms[0]->permestado : 0; 
			?>
			<tr>
				<td><?php echo $l->modudescri ?></td>
				<td><?php echo $l->sumodescri ?></td>
				<td><?php echo $cusuarios->valoresPermiso($perm,'texto'); ?></td>
				<td>
					<button type="button" class="btn btn-<?php echo $cusuarios->valoresPermiso($perm,'clase') ?>" onclick="updatePermiso('valor=<?php echo $cusuarios->valoresPermiso($perm,'valor'); ?>&usuaide=<?php echo $usuaide ?>&sumoide=<?php echo $l->sumoide ?>')">
						<?php echo $cusuarios->valoresPermiso($perm,'boton') ?>
					</button>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<script type="text/javascript">
	function updatePermiso(valores) {
		$.post('app/usuarios/prc/_permisos.update.php',valores,function(data){
			load('app/usuarios/vst/permisos.lista.php','usuaide=<?php echo $usuaide ?>','lista-permisos');
		})
	}
</script>