<?php 
require '../../../cfg/base.php';
?>
<form class="delete">
	<?php echo $fn->modalHeader('Borrar Cliente') ?>
	<div class="modal-body">
		<div class="alert alert-info">
			¿Realmente Desea borrar el cliente seleccionado?
		</div>
		<div class="msj"></div>
	</div>
	<?php echo $fn->modalFooter(); ?>
	<input type="hidden" name="clieide" value="<?php echo $clieide ?>">
</form>
<script type="text/javascript">
	$('.delete').submit(function(e){
		e.preventDefault();
		$.post('app/clientes/prc/_clientes.delete.php',$(this).serialize(),function(data){
			if(data==1) {
				cerrarmodal();
				load('app/clientes/vst/clientes.lista.php','','clientes-lista');
			} else {
				alerta('msj','danger','No se puede realizar la eliminación ya que este cliente posee registros Asociados',data);
			}
		})
	})
</script>