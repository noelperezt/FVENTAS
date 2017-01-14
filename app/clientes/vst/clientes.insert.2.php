<?php 
require '../../../cfg/base.php'; 
?>
<form class="form-horizontal insert">
	<?php echo $fn->modalHeader('Agregar Cliente') ?>
	<div class="modal-body">
	<div class="msj"></div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-3 bolder">
				Nacionalidad:
			</label>
			<div class="col-sm-9">
				<select name="nacion" class="form-control">
					<option value="V">Venezolano</option>
					<option value="E">Extranjero</option>
				</select>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-3 bolder">
				Cédula:
			</label>
			<div class="col-sm-9">
				<input class="form-control" name="cedula" maxlength = "8"></input>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-3 bolder">
				Razón Social:
			</label>
			<div class="col-sm-9">
				<input class="form-control" name="razsoc"></input>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-3 bolder">
				Dirección:
			</label>
			<div class="col-sm-9">
				<input class="form-control" name="direcc"></input>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-3 bolder">
				Teléfono:
			</label>
			<div class="col-sm-9">
				<input class="form-control" name="telefo" maxlength="11"></input>
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
				nacion: {
					required: true,
				},
				cedula: {
					required: true,
					number: true,
				},
				razsoc: {
					required: true,
				},
				telefo: {
					number: true
				},
			},
			 messages: {
				nacion: {
					required: 'Obligatorio',
				},
				cedula: {
					required: 'Obligatorio',
					number: 'Numérico',
				},
				razsoc: {
					required: 'Obligatorio',
				},
				telefo: {
					number: 'Numérico'
				},
			},
			submitHandler: function(form) {
				$.post('app/clientes/prc/_clientes.insert.2.php',$(formulario).serialize(),function(data){
					load('app/ventas/vst/ventas.perfil.cliente.php','clieide='+data,'ventas-perfil-cliente')
					cerrarmodal();
				})
			}
		});
	})
</script>