<?php 
require '../../../cfg/base.php';
?>
<form class="delete">
	<?php echo $fn->modalHeader('Borrar Producto') ?>
	<div class="modal-body">
		<div class="alert alert-info">
			¿Realmente Desea borrar el producto seleccionado?
		</div>
		<div class="msj"></div>
	</div>
	<?php echo $fn->modalFooter(); ?>
	<input type="hidden" name="prodide" value="<?php echo $prodide ?>">
</form>
<script type="text/javascript">
	$('.delete').submit(function(e){
		e.preventDefault();
		$.post('app/productos/prc/_productos.delete.php',$(this).serialize(),function(data){
			if(data==1) {
				cerrarmodal();
				load('app/productos/vst/productos.lista.php','','productos-lista');
			} else {
				alerta('msj','danger',data);
			}
		})
	})
</script>