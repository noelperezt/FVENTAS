<?php $dp = $mempresa->getAll(); ?>
<form class="form-horizontal update col-sm-8 col-sm-offset-2" action="app/empresa/prc/_empresa.update.php" method="post" enctype="multipart/form-data">
	<div class="msj"></div>
	<div class="form-group col-sm-12">
		<label class="control-label col-sm-4 bolder">
			RIF:
		</label>
		<div class="col-sm-8">
			<input class="form-control" name="rif" maxlength="11" value="<?php echo $dp[0]->emprrif ?>"></input>
		</div>
	</div>
	<div class="form-group col-sm-12">
		<label class="control-label col-sm-4 bolder">
			Razón Social:
		</label>
		<div class="col-sm-8">
			<input class="form-control" name="razon" value="<?php echo $dp[0]->emprrazsoc ?>"></input>
		</div>
	</div>
	<div class="form-group col-sm-12">
		<label class="control-label col-sm-4 bolder">
			Logo (1000x140):
		</label>
		<div class="col-sm-8">
			<input type="file" class="form-control" name="logo" value="<?php echo $dp[0]->emprlogo ?>"></input>
		</div>
	</div>
	<div class="form-group col-sm-12">
		<label class="control-label col-sm-4 bolder">
			Lema:
		</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="lema" id="clave" value="<?php echo $dp[0]->emprlema ?>"></input>
		</div>
	</div>
	<div class="space-10"></div>
	<div class="form-actions clearfix">
		<button class="btn btn-block btn-primary">Guardar Cambios</button>
	</div>
	<input type="hidden" name="empride" value="<?php echo $dp[0]->empride ?>">
</form>

<script>
	/*$(function(){
		var formulario = '.update'
		$(formulario).validate({
			rules: {
				rif: {
					required: true,
				},
				razsoc: {
					required: true,
				},
				logo: {
					required: true,
				},
				lema: {
					required: true,
				},
			},
			 messages: {
				rif: {
					required: 'Obligatorio',
				},
				razsoc: {
					required: 'Obligatorio',
				},
				logo: {
					required: 'Obligatorio',
				},
				lema: {
					required: 'Obligatorio',
				},
			},
			submitHandler: function(form) {
				$.post('app/empresa/prc/_empresa.update.php',$(formulario).serialize(),function(data){
					if(data==1) {
						alerta('msj','success','Cambios guardados correctamente')
					} else {
						alerta('msj','danger',data)
					}
				})
			}
		});
	})*/
</script>