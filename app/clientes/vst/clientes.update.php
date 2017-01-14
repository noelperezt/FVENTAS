<?php 
require '../../../cfg/base.php'; 
$dp = $mclientes->clienteIde($clieide)
?>
<form class="form-horizontal update">
	<?php echo $fn->modalHeader('Editar Cliente') ?>
	<div class="modal-body">
	<div class="msj"></div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-3 bolder">
				Nacionalidad:
			</label>
			<div class="col-sm-9">
				<select name="nacion" class="form-control">
					<option value="V" <?php echo $fn->selected($dp[0]->clienacion,'V') ?>>Venezolano</option>
					<option value="E" <?php echo $fn->selected($dp[0]->clienacion,'E') ?>>Extranjero</option>
				</select>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-3 bolder">
				Cédula:
			</label>
			<div class="col-sm-9">
				<input class="form-control" name="cedula" maxlength="8" value="<?php echo $dp[0]->cliecedula ?>"></input>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-3 bolder">
				Razón Social:
			</label>
			<div class="col-sm-9">
				<input class="form-control" name="razsoc" value="<?php echo $dp[0]->clierazsoc ?>"></input>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-3 bolder">
				Dirección:
			</label>
			<div class="col-sm-9">
				<input class="form-control" name="direcc" value="<?php echo $dp[0]->cliedirecc ?>"></input>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-3 bolder">
				Teléfono:
			</label>
			<div class="col-sm-9">
				<input class="form-control" name="telefo" maxlength="11" value="<?php echo $dp[0]->clietelefo ?>"></input>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<?php echo $fn->modalFooter(); ?>
	<input type="hidden" name="clieide" value="<?php echo $dp[0]->clieide ?>">
</form>

<script>
	$(function(){
		var formulario = '.update'
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
				$.post('app/clientes/prc/_clientes.update.php',$(formulario).serialize(),function(data){
					if(data==1) {
						load('app/clientes/vst/clientes.lista.php','','clientes-lista');
						cerrarmodal()
					} else {
						alerta('msj','danger',data)
					}
				})
			}
		});
	})
</script>