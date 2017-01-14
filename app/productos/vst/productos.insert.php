<?php require '../../../cfg/base.php'; $medidas = $mproductos->getAllmedidas() ?>
<form class="form-horizontal insert">
	<?php echo $fn->modalHeader('Agregar Producto') ?>
	<div class="modal-body">
	<div class="msj"></div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-4 bolder">
				Código:
			</label>
			<div class="col-sm-8">
				<input class="form-control" name="cod"></input>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-4 bolder">
				Descripción:
			</label>
			<div class="col-sm-8">
				<input class="form-control" name="descri"></input>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-4 bolder">
				Precio:
			</label>
			<div class="col-sm-8">
				<input class="form-control" name="precio"></input>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<label class="control-label col-sm-4 bolder">
				Stock Mínimo:
			</label>
			<div class="col-sm-8">
				<input class="form-control" name="stock"></input>
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
						<option value="<?php echo $m->unmeide ?>"><?php echo $m->unmedescri ?></option>
					<?php } ?>
				</select>
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
				cod: {
					required: true,
					number: true,
				},
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
				 cod: {
					required: 'Campo obligatorio',
					number: 'Numérico',
				},
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
				$.post('app/productos/prc/_productos.insert.php',$(formulario).serialize(),function(data){
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