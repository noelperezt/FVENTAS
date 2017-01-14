<?php 
require '../../../cfg/base.php';
?>
<form class="delete">
	<?php echo $fn->modalHeader('Borrar Usuario') ?>
	<div class="modal-body">
		<div class="alert alert-info">
			¿Realmente Desea borrar al usuario seleccionado?
		</div>
		<div class="msj"></div>
	</div>
	<?php echo $fn->modalFooter(); ?>
	<input type="hidden" name="usuaide" value="<?php echo $usuaide ?>">
</form>
<script type="text/javascript">
	$('.delete').submit(function(e){
		e.preventDefault();
		$.post('app/usuarios/prc/_usuarios.delete.php',$(this).serialize(),function(data){
			if(data==1) {
				cerrarmodal();
				load('app/usuarios/vst/usuarios.lista.php','','usuarios-lista');
			} else {
				alerta('msj','danger',data);
			}
		})
	})
</script>