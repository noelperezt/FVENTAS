<?php 
require '../../../cfg/base.php';
?>
<form class="delete">
	<?php echo $fn->modalHeader('Borrar Proveedor') ?>
	<div class="modal-body">
		<div class="alert alert-info">
			¿Realmente Desea borrar el proveedor seleccionado?
		</div>
		<div class="msj"></div>
	</div>
	<?php echo $fn->modalFooter(); ?>
	<input type="hidden" name="provide" value="<?php echo $provide ?>">
</form>
<script type="text/javascript">
	$('.delete').submit(function(e){
		e.preventDefault();
		$.post('app/proveedores/prc/_clientes.delete.php',$(this).serialize(),function(data){
			if(data==1) {
				cerrarmodal();
				load('app/proveedores/vst/clientes.lista.php','','clientes-lista');
			} else {
				alerta('msj','danger','No se puede realizar la eliminación ya que este Proveedor posee registros Asociados',data);
			}
		})
	})
</script>