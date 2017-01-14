<?php 
require '../../../cfg/base.php'; 
?>
<form class="form-horizontal insert">
	<?php echo $fn->modalHeader('Agregar Proveedor') ?>
	<div class="modal-body">
	<div class="msj"></div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-3 bolder">
				RIF:
			</label>
			<div class="col-sm-9">
				<input class="form-control" name="rif"></input>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-3 bolder">
				Razón Social:
			</label>
			<div class="col-sm-9">
				<input class="form-control" name="razon"></input>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-3 bolder">
				Dirección:
			</label>
			<div class="col-sm-9">
				<input class="form-control" name="direccion"></input>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-3 bolder">
				Teléfono:
			</label>
			<div class="col-sm-9">
				<input class="form-control" name="telefono"></input>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-3 bolder">
				Correo:
			</label>
			<div class="col-sm-9">
				<input class="form-control" name="correo"></input>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<?php echo $fn->modalFooter(); ?>
</form>

<script>
	$(function(){
		var formulario = '.insert'
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
				$.post('app/proveedores/prc/_clientes.insert.php',$(formulario).serialize(),function(data){
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