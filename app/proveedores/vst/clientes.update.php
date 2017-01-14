<?php 
require '../../../cfg/base.php'; 
$dp = $mproveedores->proveedorIde($provide)
?>
<form class="form-horizontal update">
	<?php echo $fn->modalHeader('Editar Proveedor') ?>
	<div class="modal-body">
	<div class="msj"></div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-3 bolder">
				RIF:
			</label>
			<div class="col-sm-9">
				<input class="form-control" name="rif" value="<?php echo $dp[0]->provrif ?>"></input>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-3 bolder">
				Razón Social:
			</label>
			<div class="col-sm-9">
				<input class="form-control" name="razon" value="<?php echo $dp[0]->provrazsoc ?>"></input>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-3 bolder">
				Dirección:
			</label>
			<div class="col-sm-9">
				<input class="form-control" name="direccion" value="<?php echo $dp[0]->provdirecc ?>"></input>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-3 bolder">
				Teléfono:
			</label>
			<div class="col-sm-9">
				<input class="form-control" name="telefono" value="<?php echo $dp[0]->provtelefo ?>"></input>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-3 bolder">
				Correo:
			</label>
			<div class="col-sm-9">
				<input class="form-control" name="correo" value="<?php echo $dp[0]->provcorreo ?>"></input>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<?php echo $fn->modalFooter(); ?>
	<input type="hidden" name="provide" value="<?php echo $dp[0]->provide ?>">
</form>

<script>
	$(function(){
		var formulario = '.update'
		$(formulario).validate({
			rules: {
				rif: {
					required: true,
				},
				razon: {
					required: true,
				},
				telefono: {
					number: true
				},
				correo: {
					email: true,
				},
			},
			 messages: {
				rif: {
					required: 'Obligatorio',
				},
				razon: {
					required: 'Obligatorio',
				},
				telefono: {
					number: 'Numérico'
				},
				correo: {
					email: 'Correo no válido',
				},
			},
			submitHandler: function(form) {
				$.post('app/proveedores/prc/_clientes.update.php',$(formulario).serialize(),function(data){
					if(data==1) {
						load('app/proveedores/vst/clientes.lista.php','','clientes-lista');
						cerrarmodal()
					} else {
						alerta('msj','danger',data)
					}
				})
			}
		});
	})
</script>