<?php require '../../../cfg/base.php'; $medidas = $mproductos->getAllmedidas() ?>
<?php $dp = $mproductos->productoIde($prodide) ?>
<form class="form-horizontal update">
	<?php echo $fn->modalHeader('Editar Producto') ?>
	<div class="modal-body">
	<div class="msj"></div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-4 bolder">
				Descripción:
			</label>
			<div class="col-sm-8">
				<input class="form-control" name="descri" value="<?php echo $dp[0]->proddescri ?>"></input>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-4 bolder">
				Precio:
			</label>
			<div class="col-sm-8">
				<input class="form-control" name="precio" value="<?php echo $dp[0]->prodprecio ?>"></input>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-4 bolder">
				Stock Mínimo:
			</label>
			<div class="col-sm-8">
				<input class="form-control" name="stock" value="<?php echo $dp[0]->prodstomin ?>"></input>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-4 bolder">
				Unidad de Medida:
			</label>
			<div class="col-sm-8">
				<select name="medida" id="" class="form-control">
					<option value=""></option>
					<?php foreach($medidas as $m) { ?>
						<option value="<?php echo $m->unmeide ?>" <?php echo $fn->selected($m->unmeide,$dp[0]->unmeide) ?>><?php echo $m->unmedescri ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<?php echo $fn->modalFooter(); ?>
	<input type="hidden" name="prodide" value="<?php echo $dp[0]->prodide ?>">
</form>

<script>
	$(function(){
		var formulario = '.update'
		$(formulario).validate({
			rules: {
				descri: {
					required: true,
				},
				precio: {
					required: true,
					number: true,
				},
				medida: {
					required: true,
				},
				stock: {
					required: true,
				},
			},
			 messages: {
				descri: {
					required: 'Campo obligatorio',
				},
				precio: {
					required: 'Campo obligatorio',
					number: 'Numérico',
				},
				medida: {
					required: 'Campo obligatorio',
				},
				stock: {
					required: 'Obligatorio',
				},
			},
			submitHandler: function(form) {
				$.post('app/productos/prc/_productos.update.php',$(formulario).serialize(),function(data){
					if(data==1) {
						load('app/productos/vst/productos.lista.php','','productos-lista');
						cerrarmodal()
					} else {
						alerta('msj','danger',data)
					}
				})
			}
		});
	})
</script>