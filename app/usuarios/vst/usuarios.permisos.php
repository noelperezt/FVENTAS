<?php require '../../../cfg/base.php'; ?>
<form class="form-horizontal insert">
	<?php echo $fn->modalHeader('Editar Permisos de Usuario') ?>
	<div class="modal-body">
		<div class="lista-permisos"></div>
	</div>
	<div class="clearfix"></div>
	<?php echo $fn->modalFooter2(); ?>
</form>
<script type="text/javascript">
	load('app/usuarios/vst/permisos.lista.php','usuaide=<?php echo $usuaide ?>','lista-permisos');
</script>