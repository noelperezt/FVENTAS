<?php 
require '../../../cfg/base.php';
?>
<form class="delete">
	<?php echo $fn->modalHeader('Anular Factura') ?>
	<div class="modal-body">
		<div class="alert alert-info">
			¿Realmente Desea Anular la Factura?
		</div>
		<div class="msj"></div>
	</div>
	<?php echo $fn->modalFooter(); ?>
	<input type="hidden" name="factide" value="<?php echo $factide ?>">
</form>
<script type="text/javascript">
	$('.delete').submit(function(e){
		e.preventDefault();
		$.post('app/ventas/prc/_factura.anular.php',$(this).serialize(),function(data){
			if(data==1) {
				cerrarmodal();
				load('app/ventas/vst/factura.lista.php','','usuarios-lista');
			} else {
				alerta('msj','danger',data);
			}
		})
	})
</script>